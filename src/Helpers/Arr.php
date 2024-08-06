<?php

namespace X3Group\CallTouch\Helpers;

/**
 * @author Daniil S.
 */
class Arr
{
    /**
     * Определите, существует ли данный ключ в предоставленном массиве.
     *
     * @param array $array $array
     * @param string $key
     * @return bool
     */
    public static function exists(array $array, string $key): bool
    {
        return array_key_exists($key, $array);
    }

    /**
     * Get an item from an array using "dot" notation.
     *
     * @param array $array $array
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get(array $array, string $key, mixed $default = null): mixed
    {
        if (static::exists($array, $key)) {
            return $array[$key];
        }

        if (!str_contains($key, '.')) {
            return $array[$key] ?? $default;
        }

        foreach (explode('.', $key) as $segment) {
            if (!static::exists($array, $segment)) {
                return $default;
            }
            $array = $array[$segment];
        }

        return $array;
    }

    /**
     * Проверьте, существует ли элемент или элементы в массиве, используя обозначение «точка».
     *
     * @param array $array $array
     * @param array $keys
     * @return bool
     */
    public static function has(array $array, array $keys): bool
    {
        if (!$array || !count($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $segment) {
                if (!static::exists($subKeyArray, $segment)) {
                    return false;
                }
                $subKeyArray = $subKeyArray[$segment];
            }
        }

        return true;
    }

    /**
     * Установите для элемента массива заданное значение, используя обозначение «точка».
     *
     * Если методу не присвоен ключ, будет заменен весь массив
     *
     * @param array $array
     * @param string| $key
     * @param mixed $value
     * @return array
     */
    public static function set(array &$array, string $key, mixed $value): array
    {
        $keys = explode('.', $key);

        foreach ($keys as $i => $key) {
            if (count($keys) === 1) {
                break;
            }

            unset($keys[$i]);

            if (!isset($array[$key]) || !is_array($array[$key])) {
                $array[$key] = [];
            }

            $array = &$array[$key];
        }

        $array[array_shift($keys)] = $value;

        return $array;
    }
}