<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);


namespace EasyUI\element;


class StepSlider extends Selector {

    /** @var string|null */
    private $submittedOptionId;

    public function getSubmittedOptionId(): ?string {
        return $this->submittedOptionId;
    }

    public function getType(): string {
        return Element::TYPE_STEP_SLIDER;
    }

    public function assignResult($result): void {
        $this->submittedOptionId = $this->getOptionByIndex($result)->getId();
    }

    public function serializeBody(): array {
        return [
            "steps" => $this->getSerializedOptions(),
            "default" => $this->getDefaultIndex()
        ];
    }


}