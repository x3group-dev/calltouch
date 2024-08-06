<?php

namespace X3Group\CallTouch\Result;

use JsonSerializable;

interface ErrorInterface extends JsonSerializable
{
    public function getCode(): int|string;

    public function getMessage(): string;

    public function getContext(): mixed;

    public function jsonSerialize(): array;
}