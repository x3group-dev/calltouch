<?php

namespace X3Group\CallTouch\Methods;

use X3Group\CallTouch\Result\ResultInterface;
use X3Group\CallTouch\Reporters\ReportedInterface;
use X3Group\CallTouch\Generator\GeneratorInterface;

/**
 * Метод отправки заявки в CallTouch
 * @author Daniil S.
 */
interface MethodInterface
{
    /**
     * Отправка заявки в CallTouch
     *
     * @param array $data Данные формы
     * @return ResultInterface
     */
    public function send(array $data): ResultInterface;

    /**
     * Указание механизма создания отчета о результате интеграции с методом CallTouch
     *
     * @param ReportedInterface $reported
     * @return self
     */
    public function setReporter(ReportedInterface $reported): self;

    /**
     * Указание генератора отправляемых данных
     *
     * @param GeneratorInterface $generator
     * @return self
     */
    public function setGenerator(GeneratorInterface $generator): self;

    /**
     * ID кабинета, которому принадлежит заявка
     *
     * @param string $modelID
     * @return self
     */
    public function setModelID(string $modelID): self;

    /**
     * Метод отправки заявки в CallTouch
     *
     * @return string
     */
    public function getMethod(): string;

    /**
     * ID кабинета к которому привязана заявка.
     *
     * @return string
     */
    public function getModelID(): string;
}
