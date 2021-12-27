<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);


namespace EasyUI\utils;


use Closure;
use pocketmine\player\Player;
use pocketmine\utils\Utils;

trait SubmitListener {

    private ?Closure $submitListener = null;

    public function getSubmitListener(): ?Closure {
        return $this->submitListener;
    }

    public function setSubmitListener(?Closure $listener): void {
        if($listener !== null) {
            Utils::validateCallableSignature(function(Player $player) {}, $listener);
        }
        $this->submitListener = $listener;
    }

    public function executeSubmitListener(Player $player): void {
        if($this->submitListener !== null) {
            ($this->submitListener)($player);
        }
    }

}