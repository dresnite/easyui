<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);


namespace EasyUI\variant;


use Closure;
use EasyUI\element\ModalOption;
use EasyUI\Form;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;

class ModalForm extends Form {

    private string $contentText;

    private ModalOption $acceptOption;
    private ModalOption $denyOption;

    public function __construct(string $title, string $contentText, ?ModalOption $acceptOption = null, ?ModalOption $denyOption = null) {
        $this->contentText = $contentText;
        $this->acceptOption = $acceptOption ?? new ModalOption("Accept");
        $this->denyOption = $denyOption ?? new ModalOption("Deny");
        parent::__construct($title);
    }

    public function getAcceptOption(): ModalOption {
        return $this->acceptOption;
    }

    public function getDenyOption(): ModalOption {
        return $this->denyOption;
    }

    public function setAcceptListener(?Closure $closure): void {
        $this->acceptOption->setSubmitListener($closure);
    }

    public function setAcceptText(string $text): void {
        $this->acceptOption->setText($text);
    }

    public function setDenyListener(?Closure $closure): void {
        $this->denyOption->setSubmitListener($closure);
    }

    public function setDenyText(string $text): void {
        $this->denyOption->setText($text);
    }

    protected function getType(): string {
        return Form::TYPE_MODAL_FORM;
    }

    public function handleResponse(Player $player, $data): void {
        if(!is_bool($data)) {
            throw new FormValidationException("$data is not a valid response");
        }

        if($data) {
            $this->onAccept($player);
            $this->acceptOption->notifySubmit($player);
        } else {
            $this->onDeny($player);
            $this->denyOption->notifySubmit($player);
        }
    }

    protected function serializeBody(): array {
        return [
            "content" => $this->contentText,
            "button1" => $this->acceptOption->getText(),
            "button2" => $this->denyOption->getText()
        ];
    }

    protected function onAccept(Player $player): void {}

    protected function onDeny(Player $player): void {}

}