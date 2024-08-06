<?php

namespace X3Group\CallTouch\Normalizers;

interface NormalizerInterface
{
    /**
     * Нормализация данных
     *
     * @param mixed $data
     * @return string
     */
    public function normalize(mixed $data): string;
}