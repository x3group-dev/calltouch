<?php

namespace X3Group\CallTouch\Methods;

use X3Group\CallTouch\MethodsEnum;

/**
 * Метод отправки заявки в CallTouch
 * @author Daniil S.
 */
interface MethodInterface
{
    /**
     * Отправка запроса в CallTouch
     * @return void
     */
    public function send(): void;

    /**
     * Получение способа отправки заявки в CallTouch
     * @return string
     */
    public function getType(): string;
}