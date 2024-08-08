<?php

namespace X3Group\CallTouch\Container\Callback;

use X3Group\CallTouch\Container\FieldMap;

class FieldContainer extends FieldMap
{
    /**
     * Указание ключа формы с которого происходит запрос.
     *
     * @param array $routeKey
     * @return $this
     * @author Daniil S.
     */
    public function setRouteKey(array $routeKey): self
    {
        $this->set('route_key', $routeKey);
        return $this;
    }
}