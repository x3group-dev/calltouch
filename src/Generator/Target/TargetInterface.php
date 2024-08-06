<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\Generator\GeneratorInterface;

interface TargetInterface extends GeneratorInterface
{
    /**
     * Символьный код генератора отправляемых данных.
     *
     * @return string
     */
    public function getCode(): string;

    /**
     * Производит указание ключа с которого необходимо брать данные
     *
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields): void;
}