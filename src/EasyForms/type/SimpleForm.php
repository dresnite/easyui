<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms\type;


use EasyForms\element\Button;
use EasyForms\Form;
use EasyForms\utils\Closable;
use pocketmine\form\FormValidationException;
use pocketmine\Player;

class SimpleForm extends Form {
    use Closable;

    /** @var Button[] */
    private $buttons = [];

    /** @var string|null */
    private $headerText;

    public function __construct(string $title, ?string $headerText = null) {
        $this->headerText = $headerText;
        parent::__construct($title);
    }

    /**
     * @return Button[]
     */
    public function getButtons(): array {
        return $this->buttons;
    }

    public function addButton(Button $button): void {
        $this->buttons[] = $button;
    }

    public function getHeaderText(): ?string {
        return $this->headerText;
    }

    public function setHeaderText(?string $headerText): void {
        $this->headerText = $headerText;
    }

    protected function getType(): string {
        return Form::TYPE_SIMPLE_FORM;
    }

    public function handleResponse(Player $player, $data): void {
        if($data === null) {
            $this->onClose();
        } elseif(!is_int($data) or !isset($this->buttons[$data])) {
            throw new FormValidationException( "Couldn't find the option $data");
        } else {
            $this->buttons[$data]->onSubmit();
        }
    }

    public function serializeBody(): array {
        return [
            "buttons" => array_map(function(Button $button) {
                return $button->jsonSerialize();
            }, $this->buttons),
            "content" => $this->headerText ?? ""
        ];
    }

}