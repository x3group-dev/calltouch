<?php

namespace X3Group\CallTouch\Exceptions;

use Throwable;

/**
 * Исключение, если объект не является наследником объекта.
 * @author Daniil S.
 */
class NotImplementedException extends SystemException
{
    public function __construct(string $message = '', Throwable $previous = null)
    {
        parent::__construct($message, 140, $previous);
    }
}