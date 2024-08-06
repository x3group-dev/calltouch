<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Generator\Attributes\AsField;

/**
 * Установка страницы которой принадлежит заявка
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniil S.
 */
#[AsField(code: 'callUrl')]
class CallUrl extends AbstractTarget
{
    /**
     * Генерация данных
     *
     * @param RequestData $storage
     * @param array $data
     * @return void
     */
    public function generate(RequestData $storage, array $data): void
    {
        $storage->url = $this->getValue($data) ?: '';
    }
}