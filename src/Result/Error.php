<?php

namespace X3Group\CallTouch\Result;

class Error implements ErrorInterface
{
    public function __construct(
        protected string $message,
        protected string|int $code = 0,
        protected mixed $context = null)
    {
    }

    public function __toString()
    {
        return $this->getMessage();
    }

    public function getCode(): int|string
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): mixed
    {
        return $this->context;
    }

    public function jsonSerialize(): array
    {
        return [
            'message' => $this->getMessage(),
            'code' => $this->getCode(),
            'context' => $this->getContext(),
        ];
    }
}