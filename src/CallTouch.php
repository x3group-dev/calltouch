<?php

namespace X3Group\CallTouch;

use Throwable;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Http\HttpClient;
use X3Group\CallTouch\Result\Error;
use X3Group\CallTouch\Result\Result;
use X3Group\CallTouch\Result\ResultInterface;
use X3Group\CallTouch\Reporters\ReportedInterface;
use X3Group\CallTouch\Generator\GeneratorInterface;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerAwareInterface;

class CallTouch implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * ID кабинета к которому привязана заявка.
     * @var string
     */
    private string $modelID = '';

    /**
     * Ключ формы с которой происходит отправка
     *
     * @var string
     */
    private string $routeKey = '';

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
     * Отправка заявки в CallTouch
     *
     * @param array $data Данные формы
     * @return ResultInterface
     */
    public function send(array $data): ResultInterface
    {
        try {
            $storage = new RequestData();
            $storage->modelID = $this->modelID;
            $storage->routeKey = $this->routeKey;

            if ($this->logger && $this->generator instanceof LoggerAwareInterface) {
                $this->generator->setLogger($this->logger);
            }

            $this->generator->generate($storage, $data);

            $result = $this->client->send($storage);

            $this->reported
                ?->setResponse($this->client->getResponse())
                ?->setRequest($this->client->getRequest());
        } catch (Throwable $throwable) {
            $result = new Result();
            $result->addError(new Error($throwable->getMessage(), $throwable->getCode()));
        }

        $this->reported
            ?->setResultValidate($result)
            ?->report();

        return $result;
    }

    /**
     * Указание механизма создания отчета о результате интеграции с методом CallTouch
     *
     * @param ReportedInterface $reported
     * @return void
     */
    public function setReporter(ReportedInterface $reported): void
    {
        $this->reported = $reported;
    }

    /**
     * Указание генератора отправляемых данных
     *
     * @param GeneratorInterface $generator
     * @return void
     */
    public function setGenerator(GeneratorInterface $generator): void
    {
        $this->generator = $generator;
    }

    /**
     * Указание ключа формы с которой происходит отправка.
     *
     * @param string $routeKey
     * @return void
     */
    public function setRouteKey(string $routeKey): void
    {
        $this->routeKey = $routeKey;
    }

    /**
     * ID кабинета, которому принадлежит заявка
     *
     * @param string $modelID
     * @return void
     */
    public function setModelID(string $modelID): void
    {
        $this->modelID = $modelID;
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
}