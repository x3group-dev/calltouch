<?php

namespace X3Group\CallTouch\Helpers;

use X3Group\CallTouch\Exceptions\NotImplementedException;

class CheckerHelper
{
    /**
     * Проверка реализации объекта.
     *
     * @param mixed $entity
     * @param mixed $actual
     * @return void
     * @throws NotImplementedException
     */
    public static function implemented(string|object $entity, string|object $actual): void
    {
        if (!is_a($entity, $actual, true) && !($entity instanceof $actual)) {
            throw new NotImplementedException(sprintf('Entity "%s" not implemented %s', $entity, $actual));
        }
    }
}