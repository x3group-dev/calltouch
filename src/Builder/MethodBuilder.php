<?php

namespace X3Group\CallTouch\Builder;

use X3Group\CallTouch\Methods\CallTouch;
use X3Group\CallTouch\Methods\MethodInterface;
use X3Group\CallTouch\MethodsEnum;
use X3Group\CallTouch\Reporters\Collection;
use X3Group\CallTouch\Container\ContainerInterface;
use X3Group\CallTouch\Generator\Facade\Generator;
use X3Group\CallTouch\Reporters\ReportedInterface;

class MethodBuilder
{
    /**
     * Генератор отправляемых данных
     *
     * @var Generator
     */
    private Generator $generator;

    /**
     * Карта свойств, для генератора данных
     *
     * @var ContainerInterface|null
     */
    private ?ContainerInterface $mapFields = null;

    /**
     * Генератор отчетов
     *
     * @var Collection
     */
    private Collection $reporter;

    /**
     * @param string $token Токен доступа к API
     * @param MethodsEnum $method Метод отправки заявки
     */
    public function __construct(
        private readonly string $token,
        private readonly MethodsEnum $method
    )
    {
        $this->generator = new Generator($this->method->value);
        $this->reporter = new Collection();
    }

    /**
     * Создание метода отправки заявки в CallTouch
     *
     * @return MethodInterface
     */
    public function make(): MethodInterface
    {
        if ($this->mapFields) {
            $this->generator->setMap($this->mapFields);
        }

        $callTouch = new CallTouch($this->token, $this->method);
        $callTouch->setGenerator($this->generator);
        $callTouch->setReporter($this->reporter);

        return $callTouch;
    }

    /**
     * Хранилище маршрутизации, для генераторов данных
     *
     * @param ContainerInterface $container
     * @return self
     */
    public function setFieldMap(ContainerInterface $container): self
    {
        $this->mapFields = $container;
        return $this;
    }

    /**
     * Добавление механизма формирования отчета
     *
     * @param ReportedInterface $reported
     * @return self
     */
    public function addReporter(ReportedInterface $reported): self
    {
        $this->reporter->add($reported);
        return $this;
    }
}