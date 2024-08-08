<?php

namespace X3Group\CallTouch\Validators;

use X3Group\CallTouch\Result\Error;
use X3Group\CallTouch\Result\Result;
use X3Group\CallTouch\Result\ResultInterface;

use Psr\Http\Message\ResponseInterface;

class CallbackValidator implements ValidatorInterface
{
    /**
     * Валидация ответа CallTouch
     *
     * @param ResponseInterface $response
     * @return ResultInterface
     */
    public function valid(ResponseInterface $response): ResultInterface
    {
        $result = new Result();

        $body = $response->getBody();
        $body->rewind();
        $contend = json_decode($body->getContents(), JSON_OBJECT_AS_ARRAY) ?? [];
        $result->setData($contend);
        $data = $contend['data'] ?? [];

        $dataError = $data['apiErrorData'] ?? [];

        if (isset($dataError['errorCode'])) {
            $result->addError(new Error($dataError['errorMessage'], $dataError['errorCode']));
        } elseif (isset($contend['message'])) {
            $result->addError(new Error($contend['message']));
        } elseif (isset($data['message'])) {
            $result->addError(new Error($data['message']));
        }

        return $result;
    }
}