<?php

namespace X3Group\CallTouch\Result;

interface ResultInterface
{
    /**
     * @return bool
     */
    public function isSuccess(): bool;

    /**
     * @param ErrorInterface $error
     * @return void
     */
    public function addError(ErrorInterface $error): void;

    /**
     * @param ErrorInterface[] $errors
     * @return void
     */
    public function addErrors(array $errors): void;

    /**
     * @param array $data
     * @return void
     */
    public function setData(array $data): void;

    /**
     * @return array
     */
    public function getData(): array;

    /**
     * @return ErrorInterface[]
     */
    public function getErrors(): array;
}