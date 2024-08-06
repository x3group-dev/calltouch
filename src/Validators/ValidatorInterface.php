<?php

namespace X3Group\CallTouch\Validators;


use X3Group\CallTouch\Result\ResultInterface;

use Psr\Http\Message\ResponseInterface;

interface ValidatorInterface
{
    public function valid(ResponseInterface $response): ResultInterface;
}