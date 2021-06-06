<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);

namespace EasyUI\utils;

use EasyUI\element\Dropdown;
use EasyUI\element\Element;
use EasyUI\element\Input;
use EasyUI\element\Slider;
use EasyUI\element\StepSlider;
use EasyUI\element\Toggle;

class FormResponse {
    private array $elements = [];

    /**
     * FormResponse constructor.
     * @param Element[] $elements
     */
    public function __construct(array $elements) {
        $this->elements = $elements;
    }

    public function getInputSubmittedText(string $inputId): string {
        $element = $this->getElement($inputId, Input::class);
        return $element === "" ? "" : $element->getSubmittedText();
    }

    public function getToggleSubmittedChoice(string $toggleId): bool {
        $element = $this->getElement($toggleId, Toggle::class);
        return $element === "" ? "" : $element->getSubmittedChoice();
    }

    public function getSliderSubmittedStep(string $sliderId): float {
        $element = $this->getElement($sliderId, Slider::class);
        return $element === "" ? "" : $element->getSubmittedStep();
    }

    public function getStepSliderSubmittedOptionId(string $sliderId): string {
        $element = $this->getElement($sliderId, StepSlider::class);
        return $element === "" ? "" : $element->getSubmittedOptionId();
    }

    public function getDropdownSubmittedOptionId(string $dropdownId): string {
        $element = $this->getElement($dropdownId, Dropdown::class);
        return $element === "" ? "" : $element->getSubmittedOptionId();
    }

    /**
     * @param string $id
     * @param string $expectedClass
     * @return Element|string
     */
    private function getElement(string $id, string $expectedClass) {
        return $this->elements[$id] ?? "";
    }
}
