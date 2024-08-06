<?php

namespace X3Group\CallTouch\Reporters;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use X3Group\CallTouch\Result\ResultInterface;

abstract class AbstractReporter implements ReportedInterface
{
    /**
     * Ответ CallTouch
     *
     * @var ResponseInterface|null
     */
    protected ?ResponseInterface $response = null;

    /**
     * Запрос к CallTouch
     *
     * @var RequestInterface|null
     */
    protected ?RequestInterface $request = null;

    /**
     * Результат валидации ответа CallTouch
     *
     * @var ResultInterface|null
     */
    protected ?ResultInterface $result = null;

    /**
     * Ответ CallTouch в "чистом" виде
     *
     * @param ResponseInterface $response
     * @return $this
     */
    public function setResponse(ResponseInterface $response): self
    {
        $this->response = $response;
        return $this;
    }

    /**
     * Запрос к CallTouch в первоначальном виде
     *
     * @param RequestInterface $request
     * @return $this
     */
    public function setRequest(RequestInterface $request): self
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Указание результата валидации ответа CallTouch
     *
     * @param ResultInterface $result
     * @return $this
     */
    public function setResultValidate(ResultInterface $result): self
    {
        $this->result = $result;
        return $this;
    }
}