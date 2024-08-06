<?php

namespace X3Group\CallTouch\Configuration;

use Throwable;

use X3Group\CallTouch\Container;
use X3Group\CallTouch\Bootstrap\ConfigBootstrap;
use X3Group\CallTouch\Exceptions\SystemException;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Получение доступа к конфигурациям CallTouch
 *
 * @final
 * @author Daniil S.
 */
final class Config
{
    /**
     * Проверка наличия конфигураций
     *
     * @param string $key
     * @return bool
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public static function has(string $key): bool
    {
        return self::getRepository()->has($key);
    }

    /**
     * Получение конфигурации.
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    public static function get(string $key = '', mixed $default = null): mixed
    {
        $repository = self::getRepository();

        try {
            if ($key === '') {
                return $repository->all();
            }

            return $repository->get($key, $default);
        } catch (Throwable) {
            throw new SystemException('Configuration not found');
        }
    }

    /**
     * Получение репозитория конфигураций.
     *
     * @return Repository
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private static function getRepository(): Repository
    {
        $container = Container::getInstance();

        if (!$container->has('Config')) {
            $loader = new ConfigBootstrap();
            $loader->bootstrap();
        }

        return $container->get('Config');
    }
}