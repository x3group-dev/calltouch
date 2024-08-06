<?php

namespace X3Group\CallTouch\Http\Builder;

use X3Group\CallTouch\Configuration\Config;
use X3Group\CallTouch\Exceptions\SystemException;

use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\Psr7\Request;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class RequestBuilder
{
    /**
     * @param string $method
     * @param string $body
     * @return Request
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    public static function make(string $method, string $body = ''): Request
    {
        $config = (array)Config::get("methods.$method.request.options", []);

        $uri = (string)($config['uri'] ?? '');
        $method = (string)($config['method'] ?? 'GET');
        $headers = (array)($config['headers'] ?? []);

        return new Request($method, new Uri($uri), $headers, $body);
    }
}