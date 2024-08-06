<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Generator\Attributes\AsField;

/**
 * Прикрепление пользовательских свойств в заявку
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniil S.
 */
#[AsField(code: 'fields')]
class Fields extends AbstractTarget
{
    /**
     * Максимальное количество дополнительных свойств
     */
    protected const COUNT_MAX = 5;

    /**
     * Генерация дополнительных свойств.
     *
     * @param RequestData $storage
     * @param array $data
     * @return void
     */
    public function generate(RequestData $storage, array $data): void
    {
        $fields = [];

        foreach ($this->fields as $key) {
            if (count($fields) >= self::COUNT_MAX) {
                break;
            }

            $fields[] = [
                'name' => $key,
                'value' => $data[$key]
            ];
        }

        $storage->fields = $fields;
    }
}