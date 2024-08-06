<?php

namespace X3Group\CallTouch\Exceptions\Cookie;

use Throwable;

/**
 * Исключение, если не удалось найти Cookie запись
 * @internal Используется при работе с Cookie
 * @author Daniil S.
 */
class CookieNotFoundException extends CookieException
{
    public function __construct(string $message = 'Cookie not found', ?Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}