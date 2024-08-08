<?php

namespace X3Group\CallTouch\Methods;

use X3Group\CallTouch\Result\ResultInterface;
use X3Group\CallTouch\Generator\GeneratorInterface;
use X3Group\CallTouch\Reporters\ReportedInterface;

class Callback extends MethodDecorator
{
    /**
     * Ключ формы
     *
     * @var string
     * @author Daniil S. GlobalArts
     */
    private string $routeKey = '';

    /**
     * Отправка запроса в CallTouch
     *
     * @param array $data
     * @return ResultInterface
     * @author Daniil S. GlobalArts
     */
    public function send(array $data): ResultInterface
    {
        $data['route_key'] = $this->routeKey;
        return $this->method->send($data);
    }

    /**
     * Указание ключа формы
     *
     * @param string $routeKey
     * @return $this
     * @author Daniil S. GlobalARts
     */
    public function setRouteKey(string $routeKey): self
    {
        $this->routeKey = $routeKey;
        return $this;
    }

    /**
     * Указание механизма создания отчета о результате интеграции с методом CallTouch
     *
     * @param ReportedInterface $reported
     * @return self
     */
    public function setReporter(ReportedInterface $reported): self
    {
        $this->method->setReporter($reported);
        return $this;
    }

    /**
     * Указание генератора отправляемых данных
     *
     * @param GeneratorInterface $generator
     * @return self
     */
    public function setGenerator(GeneratorInterface $generator): self
    {
        $this->method->setGenerator($generator);
        return $this;
    }

    /**
     * ID кабинета, которому принадлежит заявка
     *
     * @param string $modelID
     * @return self
     */
    public function setModelID(string $modelID): self
    {
        $this->method->setModelID($modelID);
        return $this;
    }

    /**
     * Метод отправки заявки в CallTouch
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method->getMethod();
    }

    /**
     * ID кабинета к которому привязана заявка
     *
     * @return string
     * @author Daniil S. GlobalArts
     */
    public function getModelID(): string
    {
        return $this->method->getModelID();
    }
}