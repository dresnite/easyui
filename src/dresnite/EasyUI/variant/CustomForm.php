<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 */

declare(strict_types=1);


namespace dresnite\EasyUI\variant;


use Closure;
use dresnite\EasyUI\element\Element;
use dresnite\EasyUI\Form;
use dresnite\EasyUI\utils\Closable;
use dresnite\EasyUI\utils\FormResponse;
use pocketmine\form\FormValidationException;
use pocketmine\player\Player;
use pocketmine\utils\Utils;

class CustomForm extends Form {
    use Closable;

    /** @var Element[] */
    private array $elements = [];

    private ?Closure $submitListener;

    public function __construct(string $title, ?Closure $submitListener = null) {
        $this->setSubmitListener($submitListener);
        parent::__construct($title);
    }

    protected function getType(): string {
        return Form::TYPE_CUSTOM_FORM;
    }

    /**
     * @return Element[]
     */
    public function getElements(): array {
        return $this->elements;
    }

    public function addElement(string $id, Element $element): void {
        $this->elements[$id] = $element;
    }

    public function getSubmitListener(): ?Closure {
        return $this->submitListener;
    }

    public function setSubmitListener(?Closure $submitListener): void {
        if($submitListener !== null) {
            Utils::validateCallableSignature(function(Player $player, FormResponse $response) {}, $submitListener);
        }
        $this->submitListener = $submitListener;
    }

    public function executeSubmitListener(Player $player, FormResponse $response): void {
        if($this->submitListener !== null) {
            ($this->submitListener)($player, $response);
        }
        $this->onSubmit($player, $response);
    }

    public function handleResponse(Player $player, $data): void {
        if($data === null) {
            $this->notifyClose($player);
        } else {
            $this->normalizeResponseData($data);

            $elementCopies = [];
            $index = 0;
            foreach($this->elements as $id => $element) {
                $copy = clone $element;
                $copy->assignResult($data[$index]);
                $elementCopies[$id] = $copy;

                $index++;
            }

            $this->executeSubmitListener($player, new FormResponse($elementCopies));
        }
    }

    private function normalizeResponseData(&$data): void {
        $actual = count($data);
        $expected = count($this->elements);
        if($actual > $expected) {
            throw new FormValidationException("Too many result elements, expected $expected, got $actual");
        } elseif($actual < $expected) {
            // In 1.21.70, the client no longer sends nulls for labels
            $expectedWithoutReadonly = 0;
            foreach($this->elements as $element) {
                if(!$element->isReadOnly()) {
                    $expectedWithoutReadonly++;
                }
            }

            if($actual !== $expectedWithoutReadonly) {
                throw new FormValidationException("Wrong number of result elements, expected either " .
                    $expected .
                    " (with readonly values, <1.21.70) or " .
                    $expectedWithoutReadonly .
                    " (without readonly values, >=1.21.70), got " .
                    $actual
                );
            }

            $normalized = [];
            $index = 0;
            foreach($this->elements as $element) {
                if($element->isReadOnly()) {
                    $normalized[] = null;
                } else {
                    $normalized[] = $data[$index] ?? null;
                    $index++;
                }
            }

            $data = $normalized;
        }
    }

    protected function serializeBody(): array {
        return [
            "content" => array_values($this->elements)
        ];
    }

    protected function onSubmit(Player $player, FormResponse $response): void {}

}