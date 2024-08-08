<?php

namespace X3Group\CallTouch\Methods;

abstract class MethodDecorator implements MethodInterface
{
    public function __construct(protected MethodInterface $method)
    {
    }
}