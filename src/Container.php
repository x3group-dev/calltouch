<?php

namespace X3Group\CallTouch;

use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    private static self $instance;
    protected array $data = [];

    private function __construct()
    {
    }

    public function get(string $id, mixed $default = null): mixed
    {
        return $this->data[$id] ?? $default;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->data);
    }

    public function set(string $key, $value): void
    {
        $this->data[$key] = $value;
    }

    public static function getInstance(): self
    {
        return self::$instance ??= new self();
    }
}