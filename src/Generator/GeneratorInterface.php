<?php

namespace X3Group\CallTouch\Generator;


use X3Group\CallTouch\DTO\RequestData;

/**
 * Производит генерацию данных перед запросом в CallTouch.
 *
 * @author Daniil S.
 */
interface GeneratorInterface
{
    /**
     * Генерирует данные
     *
     * @param RequestData $storage Хранилище отправляемых данных
     * @param array $data Данные формы
     * @return void
     */
    public function generate(RequestData $storage, array $data): void;
}