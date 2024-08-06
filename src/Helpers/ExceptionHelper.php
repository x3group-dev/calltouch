<?php

namespace X3Group\CallTouch\Helpers;

use Throwable;

class ExceptionHelper
{
    /**
     * Преобразование исключения в строку.
     * Данное преобразование хорошо подходит, для логирования.
     * @param Throwable $throwable
     * @return false|string
     */
    public static function toString(Throwable $throwable)
    {
        $trace = [];

        foreach ($throwable->getTrace() as $value) {
            if (!is_array($value['args'])) {
                $value['args'] = [];
            }

            foreach ($value['args'] as &$argument) {
                if (is_object($argument)) {
                    $argument = sprintf('Object(%s)', $argument::class);
                }
            }

            $trace[] = $value;
        }

        return json_encode(
            [
                'message' => $throwable->getMessage(),
                'code' => $throwable->getCode(),
                'trace' => $trace
            ],
            JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES
        );
    }
}