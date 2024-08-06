<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Exceptions\SystemException;
use X3Group\CallTouch\Generator\Attributes\AsField;

/**
 * Производит приведение номера телефона к каноничному формату и запись в хранилище
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniil S.
 */
#[AsField(code: 'phone')]
class Phone extends AbstractTarget
{
    public function generate(RequestData $storage, array $data): void
    {
        $phone = $this->getValue($data);

        if (!$phone) {
            throw new SystemException('Phone number not found');
        }

        $storage->phone = preg_replace('/[^\d]+/', '', $phone);
    }
}