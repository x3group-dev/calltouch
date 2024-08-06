<?php

namespace X3Group\CallTouch\Generator\Attributes;

use Attribute;

#[Attribute(Attribute::TARGET_CLASS)]
class AsField
{
    public function __construct(
        public string $code = '',
        public array $map = []
    )
    {
    }
}