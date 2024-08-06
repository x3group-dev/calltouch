<?php

namespace X3Group\CallTouch\Result;

class Result implements ResultInterface
{
    protected bool $success = true;
    protected array $data = [];
    protected array $errors = [];

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function addError(ErrorInterface $error): void
    {
        $this->success = false;
        $this->errors[] = $error;
    }

    public function addErrors(array $errors): void
    {
        $this->success = false;
        array_walk($errors, [$this, 'addError']);
    }

    public function setData(array $data): void
    {
        $this->data = $data;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}