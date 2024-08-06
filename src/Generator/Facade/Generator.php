<?php

namespace X3Group\CallTouch\Generator\Facade;

use X3Group\CallTouch\Container\ContainerInterface;
use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Exceptions\SystemException;
use X3Group\CallTouch\Configuration\Config;
use X3Group\CallTouch\Generator\GeneratorInterface;
use X3Group\CallTouch\Generator\Target\TargetInterface;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Generator implements GeneratorInterface
{
    private array $generators;
    private ?ContainerInterface $map = null;

    public function __construct(private readonly string $method)
    {
    }

    /**
     * Генерация отправляемых данных
     * @param RequestData $storage
     * @param array $data
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    public function generate(RequestData $storage, array $data): void
    {
        foreach ($this->getGenerators() as $generator) {
            if ($generator instanceof TargetInterface && null !== $this->map && $this->map->has($generator->getCode())) {
                $field = $this->map->get($generator->getCode());
                $generator->setFields($field);
            }

            $generator->generate($storage, $data);
        }
    }

    /**
     * Карта соответствия полей генератора
     *
     * @param ContainerInterface $map
     * @return void
     */
    public function setMap(ContainerInterface $map): void
    {
        $this->map = $map;
    }

    /**
     * @return GeneratorInterface[]
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    protected function getGenerators(): array
    {
        return $this->generators ??= $this->load();
    }

    /**
     * Загрузка зарегистрированных генераторов.
     * @return array
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    private function load(): array
    {
        $result = [];
        $key = sprintf('methods.%s.generators', $this->method);
        $entities = Config::get($key, []);

        foreach ($entities as $entity) {
            $generator = new $entity();
            $result[spl_object_id($generator)] = $generator;
        }

        return $result;
    }
}