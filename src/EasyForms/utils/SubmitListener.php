<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms\utils;


use Closure;
use pocketmine\utils\Utils;

trait SubmitListener {

    /** @var Closure|null */
    private $submitListener = null;

    public function getSubmitListener(): ?Closure {
        return $this->submitListener;
    }

    public function setSubmitListener(?Closure $listener): void {
        if($this->submitListener !== null) {
            Utils::validateCallableSignature(function(self $button) {}, $this->submitListener);
        }
        $this->submitListener = $listener;
    }

    public function executeSubmitListener(): void {
        if($this->submitListener !== null) {
            ($this->submitListener)($this);
        }
    }

}