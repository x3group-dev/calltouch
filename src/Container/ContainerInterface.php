<?php

namespace X3Group\CallTouch\Container;

use Psr\Container\ContainerInterface as PSR;

interface ContainerInterface extends PSR
{
    /**
     * Указание записи
     *
     * @param string $id
     * @param mixed $value
     * @return void
     */
    public function set(string $id, mixed $value): void;

    /**
     * Удаление записи
     *
     * @param string $id
     * @return void
     */
    public function remove(string $id): void;
}