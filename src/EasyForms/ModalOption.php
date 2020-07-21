<?php
/*
 * Copyright (C) GiantQuartz - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

declare(strict_types=1);


namespace EasyForms;


class ModalOption {
    use Submittable;

    /** @var string */
    private $text;

    public function __construct(string $text) {
        $this->text = $text;
    }

    public function getText(): string {
        return $this->text;
    }

    public function setText(string $text): void {
        $this->text = $text;
    }

}