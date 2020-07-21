<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms;


use pocketmine\form\Form as PmForm;

abstract class Form implements PmForm {

    /** @var string */
    private $title;

    public const TYPE_SIMPLE_FORM = "form";
    public const TYPE_CUSTOM_FORM = "custom_form";
    public const TYPE_MODAL_FORM = "modal_form";

    public function __construct(string $title) {
        $this->title = $title;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    abstract protected function getType(): string;

    abstract protected function serializeBody(): array;

    public function jsonSerialize(): array {
        $body = $this->serializeBody();
        $body["title"] = $this->title;
        return $body;
    }

}