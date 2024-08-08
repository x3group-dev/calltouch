<?php

namespace X3Group\CallTouch\Builder;

use X3Group\CallTouch\MethodsEnum;
use X3Group\CallTouch\Methods\Callback;
use X3Group\CallTouch\Methods\MethodInterface;
use X3Group\CallTouch\Reporters\ReportedInterface;
use X3Group\CallTouch\Container\Callback\FieldContainer;

/**
 * Сборщик метода отправки заявки на обратный звонок
 *
 * @author Daniil S.
 */
class CallbackBuilder
{
    /**
     * Сборщик метода отправки заявки
     *
     * @var MethodBuilder
     */
    private MethodBuilder $factory;

    /**
     * Карта свойств
     *
     * @var FieldContainer
     */
    private FieldContainer $map;

    /**
     * Ключ формы
     *
     * @var string
     */
    private string $routeKey = '';

    public function __construct(string $token)
    {
        $this->factory = new MethodBuilder($token, MethodsEnum::CallBack);
        $this->map = new FieldContainer();
        $this->factory->setFieldMap($this->map);
    }

    /**
     * Создание метода отправки заявок обратного звонка
     *
     * @return MethodInterface
     */
    public function make(): MethodInterface
    {
        $ct = $this->factory->make();
        $callback = new Callback($ct);

        return $callback->setRouteKey($this->routeKey);
    }

    /**
     * Указание ключа формы
     *
     * @param string $routeKey
     * @return $this
     */
    public function setRouteKey(string $routeKey): self
    {
        $this->routeKey = $routeKey;
        $this->getFieldMap()->setRouteKey(['route_key']);

        return $this;
    }

    /**
     * Указание механизма формирования отчета
     *
     * @param ReportedInterface $reported
     * @return $this
     */
    public function addReporter(ReportedInterface $reported): self
    {
        $this->factory->addReporter($reported);
        return $this;
    }

    /**
     * Получение карты свойств
     *
     * @return FieldContainer
     */
    public function getFieldMap(): FieldContainer
    {
        return $this->map;
    }
}
