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

trait CloseListener {

    /** @var Closure|null */
    private $closeListener = null;

    public function getCloseListener(): ?Closure {
        return $this->closeListener;
    }

    public function setCloseListener(?Closure $listener): void {
        if($this->closeListener !== null) {
            Utils::validateCallableSignature(function(self $button) {}, $this->closeListener);
        }
        $this->closeListener = $listener;
    }

    public function executeCloseListener(): void {
        if($this->closeListener !== null) {
            ($this->closeListener)($this);
        }
    }

}