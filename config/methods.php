<?php

use X3Group\CallTouch\Generator\Target;
use X3Group\CallTouch\Validators;
use X3Group\CallTouch\MethodsEnum;
use X3Group\CallTouch\Normalizers;

return [
    MethodsEnum::CallBack->value => [
        'requestNormalizer' => Normalizers\Request\CallbackNormalizer::class,
        'responseNormalizers' => [],
        'generators' => [
            Target\Phone::class,
            Target\CallUrl::class,
            Target\Utm::class,
            Target\Session::class,
            Target\Fields::class,
            Target\Tags::class,
            Target\RouteKey::class,
        ],
        'reporters' => [],
        'validator' => Validators\CallbackValidator::class,
        'request' => [
            'options' => [
                'uri' => 'https://api.calltouch.ru/widget-service/v1/api/widget-request/user-form/create',
                'method' => 'POST',
                'headers' => [
                    'Content-Type' => 'application/json',
                ]
            ]
        ]
    ]
];