<?php

namespace X3Group\CallTouch\Methods;

use Throwable;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Result\Error;
use X3Group\CallTouch\Result\Result;
use X3Group\CallTouch\Result\ResultInterface;

class CallTouch extends AbstractMethod
{
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
            $storage->modelID = $this->getModelID();

            $this->getGenerator()->generate($storage, $data);

            $provider = $this->getProvider();
            $result = $provider->send($storage);

            $this->getReporter()
                ?->setResponse($provider->getResponse())
                ?->setRequest($provider->getRequest());
        } catch (Throwable $throwable) {
            $result = new Result();
            $result->addError(new Error($throwable->getMessage(), $throwable->getCode()));
        }

        try {
            $this->getReporter()
                ?->setResultValidate($result)
                ?->report();
        } catch (Throwable $throwable) {
            $result->addError(new Error($throwable->getMessage(), $throwable->getCode()));
        }

        return $result;
    }
}