<?php

namespace X3Group\CallTouch\Validators;

use X3Group\CallTouch\Configuration\Config;
use X3Group\CallTouch\Helpers\CheckerHelper;

class Builder
{
    public static function make(string $method): ValidatorInterface
    {
        $validator = Config::get("methods.$method.validator");
        CheckerHelper::implemented($validator, ValidatorInterface::class);

        return new $validator;
    }
}