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