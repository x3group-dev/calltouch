<?php

namespace X3Group\CallTouch\Helpers;

use X3Group\CallTouch\Exceptions\Cookie\CookieNotFoundException;
use X3Group\CallTouch\Exceptions\Cookie\InvalidFormatException;

/**
 * Работа с Cookie данными кабинетов
 *
 * @internal Используется перед отправкой заявки в CallTouch
 * @author Daniil S.
 */
class CookieHelper
{
    /**
     * Получение ID сессии по умолчанию
     *
     * <p style="color: red">Данный метод не подходит, если в системе более 1 кабинета</p>
     * @return string
     */
    public static function getDefaultSession(): string
    {
        return (string)($_COOKIE['_ct_session_id'] ?? '');
    }

    /**
     * Получение ID сессии пользователя в рамках кабинета CallTouch
     * @param string $modelID
     * @return string
     * @throws CookieNotFoundException
     * @throws InvalidFormatException
     */
    public static function getSessionByModelID(string $modelID): string
    {
        $data = self::getDataByModelID($modelID);
        return (string)($data['sessionId'] ?? '');
    }

    /**
     * Получение данных кабинета CallTouch
     * @param string $modelID
     * @return array
     * @throws CookieNotFoundException
     * @throws InvalidFormatException
     */
    public static function getDataByModelID(string $modelID): array
    {
        $key = self::generateKeyByModelID($modelID);

        if (!array_key_exists($key, $_COOKIE)) {
            throw new CookieNotFoundException();
        }

        if (!is_string($_COOKIE[$key])) {
            throw new InvalidFormatException('Invalid account data format');
        }

        return json_decode($_COOKIE[$key], true) ?: [];
    }

    /**
     * Генерация ключа cookie по ID личного кабинета.
     * @param string $modelID ID личного кабинета
     * @return string
     */
    public static function generateKeyByModelID(string $modelID): string
    {
        return sprintf('x3group_ct_modelID_%s', $modelID);
    }
}