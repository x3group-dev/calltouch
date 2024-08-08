<?php

namespace X3Group\CallTouch\Methods;

use X3Group\CallTouch\Generator\GeneratorInterface;
use X3Group\CallTouch\Http\HttpClient;
use X3Group\CallTouch\MethodsEnum;
use X3Group\CallTouch\Reporters\ReportedInterface;

abstract class AbstractMethod implements MethodInterface
{
    /**
     * ID кабинета к которому привязана заявка.
     * @var string
     */
    private string $modelID = '';

    /**
     * Производит подготовку данных, для отправки
     *
     * @var GeneratorInterface|null
     */
    private ?GeneratorInterface $generator = null;

    /**
     * Производит формирование отчета результата интеграции с CallTouch
     *
     * @var ReportedInterface|null
     */
    private ?ReportedInterface $reported = null;

    /**
     * Шина общения с сервером CallTouch
     *
     * @var HttpClient
     */
    private HttpClient $client;

    public function __construct(
        private readonly string      $token,
        private readonly MethodsEnum $method
    )
    {
        $this->client = new HttpClient($this->getMethod(), $this->token);
    }

    /**
     * Указание механизма создания отчета о результате интеграции с методом CallTouch
     *
     * @param ReportedInterface $reported
     * @return self
     */
    public function setReporter(ReportedInterface $reported): self
    {
        $this->reported = $reported;
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
        $this->generator = $generator;
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
        $this->modelID = $modelID;
        return $this;
    }

    /**
     * Метод отправки заявки в CallTouch
     *
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method->value;
    }

    /**
     * ID кабинета к которому привязана заявка
     *
     * @return string
     * @author Daniil S.
     */
    public function getModelID(): string
    {
        return $this->modelID;
    }

    /**
     * Получение генератора данных
     *
     * @return GeneratorInterface|null
     * @author Daniil S.
     */
    protected function getGenerator(): ?GeneratorInterface
    {
        return $this->generator;
    }

    /**
     * Получение механизма формирования отчета.
     *
     * @return ReportedInterface|null
     * @author Daniil S.
     */
    protected function getReporter(): ?ReportedInterface
    {
        return $this->reported;
    }

    /**
     * Получение шины общения
     *
     * @return HttpClient
     * @author Daniil S.
     */
    protected function getProvider(): HttpClient
    {
        return $this->client;
    }
}
