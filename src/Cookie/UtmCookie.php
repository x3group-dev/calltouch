<?php

namespace X3Group\CallTouch\Cookie;

class UtmCookie
{
    protected string $key = "X3GROUP_CT_UTM";

    /**
     * Записать данные в сессию
     *
     * @param array $values
     * @return void
     */
    public function set(array $values): void
    {
        $data = json_encode($values);
        setcookie($this->key, json_encode($values), time() + 3600);
        $_COOKIE[$this->key] = $data;
    }

    /**
     * Получение данных из сессии.
     * @return array
     */
    public function get(): array
    {
        if (!array_key_exists($this->key, $_COOKIE)) {
            return [];
        }

        return (array)json_decode($_COOKIE[$this->key], JSON_OBJECT_AS_ARRAY);
    }
}