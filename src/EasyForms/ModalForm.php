<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms;


use Closure;
use pocketmine\form\FormValidationException;
use pocketmine\Player;

class ModalForm extends Form {

    /** @var string */
    private $contentText;

    /** @var ModalOption */
    private $acceptOption;

    /** @var ModalOption */
    private $denyOption;

    public function __construct(string $title, string $contentText, ?ModalOption $acceptOption = null, ?ModalForm $denyOption = null) {
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