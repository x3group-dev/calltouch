<?php

namespace X3Group\CallTouch\Generator\Target;

use ReflectionClass;
use ReflectionAttribute;

use X3Group\CallTouch\Generator\Attributes\AsField;

abstract class AbstractTarget implements TargetInterface
{
    /**
     * Обрабатываемые свойства
     *
     * @var array
     */
    protected array $fields = [];

    /**
     * Конфигурация генератора
     *
     * @var AsField
     */
    protected AsField $configuration;

    public function __construct()
    {
        $this->loadConfiguration();
    }

    /**
     * Получение кода генератора отправляемых данных
     *
     * @final
     * @return string
     */
    final public function getCode(): string
    {
        return $this->configuration->code ?? '';
    }

    /**
     * Наименование свойства принадлежащее получаемым данным.
     *
     * Производит указание ключа с которого необходимо брать данные
     *
     * @param array $fields
     * @return void
     */
    public function setFields(array $fields): void
    {
        $this->fields = $fields;
    }

    /**
     * Получение первого найденного значения.
     *
     * @param array $data
     * @return mixed
     */
    protected function getValue(array $data): mixed
    {
        foreach ($this->fields as $key) {
            if (array_key_exists($key, $data)) {
                return $data[$key];
            }
        }

        return null;
    }

    /**
     * Проверка возможности поддержки работы генератора данных.
     * @param array $data
     * @return bool
     */
    protected function supported(array $data): bool
    {
        foreach ($this->fields as $key) {
            if (array_key_exists($key, $data)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Загрузка конфигураций генератора
     *
     * @return void
     */
    private function loadConfiguration(): void
    {
        $reflection = new ReflectionClass($this);
        $attribute = current($reflection->getAttributes(AsField::class));

        if ($attribute instanceof ReflectionAttribute) {
            $this->configuration = $attribute->newInstance();
        }
    }
}