<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Generator\Attributes\AsField;

#[AsField(code: 'tags')]
class Tags extends AbstractTarget
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
        $tags = $this->getValue($data);

        if (!is_array($tags)) {
            return;
        }

        $storage->tags = array_values(array_slice($tags, 0, 10));
    }
}