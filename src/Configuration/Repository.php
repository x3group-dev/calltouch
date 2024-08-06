<?php

namespace X3Group\CallTouch\Configuration;

use ArrayAccess;
use X3Group\CallTouch\Helpers\Arr;
use Psr\Container\ContainerInterface;

/**
 * Хранилище конфигураций CallTouch
 * @internal Использовать строго в рамках пакета
 * @author Daniil S.
 */
class Repository implements ArrayAccess, ContainerInterface
{
    /**
     * Конфигурация
     * @var array
     */
    private array $items = [];

    /**
     * Проверка наличия конфигурации
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return Arr::has($this->items, [$id]);
    }

    /**
     * Получение конфигурации
     * @param string $id
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $id, mixed $default = null): mixed
    {
        return Arr::get($this->items, $id, $default);
    }

    /**
     * Указание значения конфигурации
     * @param string|iterable $key
     * @param $value
     * @return void
     */
    public function set(iterable|string $key, $value = null): void
    {
        $keys = is_array($key) ? $key : [$key => $value];

        foreach ($keys as $key => $value) {
            Arr::set($this->items, $key, $value);
        }
    }

    /**
     * Получение всех конфигураций
     * @return array
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Проверка наличия значения
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->has($offset);
    }

    /**
     * Получение значения
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->get($offset);
    }

    /**
     * Установка значения
     * @param mixed $offset
     * @param mixed $value
     * @return void
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->set($offset, $value);
    }

    /**
     * Удаление записи
     * @param mixed $offset
     * @return void
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->set($offset);
    }
}