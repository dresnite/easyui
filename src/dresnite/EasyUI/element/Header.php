<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);


namespace EasyUI\element;


class Header extends Element {

    public function __construct(string $headerText) {
        parent::__construct($headerText);
    }

    public function isReadOnly(): bool {
        return true;
    }

    public function getType(): string {
        return Element::TYPE_HEADER;
    }

    public function assignResult($result): void {
        // noop
    }

    public function serializeBody(): array {
        return [];
    }

}