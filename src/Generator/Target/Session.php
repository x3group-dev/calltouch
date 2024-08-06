<?php

namespace X3Group\CallTouch\Generator\Target;

use Throwable;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Helpers\CookieHelper;
use X3Group\CallTouch\Generator\GeneratorInterface;

/**
 * Производит установку сессии посетителя.
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniil S.
 */
class Session implements GeneratorInterface
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
        $session = '';

        if (!$storage->modelID) {
            $cookiePrefix = CookieHelper::generateKeyByModelID('');
            $accounts = array_filter($_COOKIE, fn($key) => str_starts_with($key, $cookiePrefix), ARRAY_FILTER_USE_KEY);

            if (1 === count($accounts)) {
                $session = CookieHelper::getDefaultSession();
            }
        } else {
            try {
                $session = CookieHelper::getSessionByModelID($storage->modelID);
            } catch (Throwable) {
            }
        }

        $storage->session = $session;
    }
}