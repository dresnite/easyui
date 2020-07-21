<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
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