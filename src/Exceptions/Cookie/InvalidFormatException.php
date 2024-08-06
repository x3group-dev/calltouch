<?php

namespace X3Group\CallTouch\Exceptions\Cookie;

use Throwable;

class InvalidFormatException extends CookieException
{
    public function __construct(string $message = '', ?Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}