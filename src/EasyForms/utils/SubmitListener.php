<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
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