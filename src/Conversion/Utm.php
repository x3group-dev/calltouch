<?php

namespace X3Group\CallTouch\Conversion;

use X3Group\CallTouch\Cookie\UtmCookie;

/**
 * Отслеживание UTM меток пользователя и сохранение в сессии
 *
 * @author Daniil S.
 */
class Utm
{
    /**
     * Поиск и сохранение UTM меток в хранилище
     * @return void
     */
    public static function search(): void
    {
        $data = [];
        $store = new UtmCookie();

        if (empty($_GET) && empty($store->get())) {
            return;
        }

        foreach ($_GET as $name => $value) {
            $name = htmlspecialchars($name);
            $value = htmlspecialchars($value);

            if (str_starts_with($name, "utm_")) {
                $data[$name] = $value;
            }
        }

        if ($data) {
            $store->set($data);
        }
    }
}