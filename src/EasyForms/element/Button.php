<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms\element;


use Closure;
use EasyForms\icon\ButtonIcon;
use EasyForms\utils\Submittable;
use JsonSerializable;

class Button implements JsonSerializable {
    use Submittable;

    /** @var string */
    private $text;

    /** @var ButtonIcon|null */
    private $icon;

    public function __construct(string $text, ?ButtonIcon $icon, ?Closure $listener) {
        $this->text = $text;
        $this->icon = $icon;
        $this->setSubmitListener($listener);
    }

    public function hasIcon(): bool {
        return $this->icon !== null;
    }

    public function getIcon(): ?ButtonIcon {
        return $this->icon;
    }

    public function setIcon(?ButtonIcon $icon): void {
        $this->icon = $icon;
    }

    public function jsonSerialize(): array {
        $data = [
            "text" => $this->text
        ];

        if($this->hasIcon()) {
            $data["icon"] = $this->icon->jsonSerialize();
        }

        return $data;
    }

}