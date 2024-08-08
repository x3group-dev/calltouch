<?php

namespace X3Group\CallTouch\Generator\Target;

use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Exceptions\SystemException;
use X3Group\CallTouch\Generator\Attributes\AsField;

#[AsField(code: 'route_key')]
class RouteKey extends AbstractTarget
{
    public function generate(RequestData $storage, array $data): void
    {
        $routeKey = (string)$this->getValue($data);

        if (empty($routeKey)) {
            throw new SystemException('Route key cannot be empty');
        }

        $storage->routeKey = $routeKey;
    }
}