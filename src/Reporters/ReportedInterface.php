<?php

namespace X3Group\CallTouch\Reporters;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use X3Group\CallTouch\Result\ResultInterface;

/**
 * Производит формирование отчета ответа сервера CallTouch
 * @author Daniil S.
 */
interface ReportedInterface
{
    /**
     * Сформировать отчет
     *
     * @return void
     */
    public function report(): void;

    /**
     * Добавление в отчет полученных данных от сервера CallTouch
     *
     * @param ResponseInterface $response
     * @return ReportedInterface
     */
    public function setResponse(ResponseInterface $response): ReportedInterface;

    /**
     * Добавление вотчет отправленные данные
     *
     * @param RequestInterface $request
     * @return ReportedInterface
     */
    public function setRequest(RequestInterface $request): ReportedInterface;

    /**
     * Добавление результата валидации ответа CallTouch
     *
     * @param ResultInterface $result
     * @return ReportedInterface
     */
    public function setResultValidate(ResultInterface $result): ReportedInterface;
}