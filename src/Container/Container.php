<?php

namespace X3Group\CallTouch\Container;

class Container implements ContainerInterface
{
    protected array $data = [];

    /**
     * Получение данных из контейнера
     *
     * @param string $id
     * @param mixed|null $default
     * @return mixed
     */
    public function get(string $id, mixed $default = null): mixed
    {
        return $this->data[$id] ?? $default;
    }

    /**
     * Проверка наличия записи
     *
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }

    /**
     * Указание записи
     *
     * @param string $id
     * @param mixed $value
     * @return Container
     */
    public function set(string $id, mixed $value): self
    {
        $this->data[$id] = $value;
        return $this;
    }

    /**
     * Удаление записи
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void
    {
        if ($this->has($id)) {
            unset($this->data[$id]);
        }
    }
}