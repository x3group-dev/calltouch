<?php

namespace X3Group\CallTouch\Http;

use GuzzleHttp\Client;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use X3Group\CallTouch\Configuration\Config;
use X3Group\CallTouch\DTO\RequestData;
use X3Group\CallTouch\Exceptions\SystemException;
use X3Group\CallTouch\Http\Builder\RequestBuilder;
use X3Group\CallTouch\Normalizers\NormalizerInterface;
use X3Group\CallTouch\Result\ResultInterface;
use X3Group\CallTouch\Validators\Builder;

class HttpClient
{
    private Client $client;
    private ?RequestInterface $request = null;
    private ?ResponseInterface $response = null;

    public function __construct(
        private readonly string $callTouchMethod,
        private readonly string $token
    )
    {
        $this->client = new Client();
    }

    /**
     * Отправка запроса в CallTouch
     *
     * @param RequestData $data
     * @return ResultInterface
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     * @throws ClientExceptionInterface
     */
    public function send(RequestData $data): ResultInterface
    {
        $body = $this->normalize($data);
        $this->request = RequestBuilder::make($this->callTouchMethod, $body);
        $this->request = $this->request->withHeader('Access-Token', $this->token);

        $this->response = $this->client->sendRequest($this->request);

        return Builder::make($this->callTouchMethod)->valid($this->response);
    }

    /**
     * Получение запроса
     *
     * @return RequestInterface|null
     */
    public function getRequest(): ?RequestInterface
    {
        return $this->request;
    }

    /**
     * Получение ответа
     *
     * @return ResponseInterface|null
     */
    public function getResponse(): ?ResponseInterface
    {
        return $this->response;
    }

    /**
     * Подготовка данных к отправке
     *
     * @param RequestData $data
     * @return string
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     * @throws SystemException
     */
    protected function normalize(RequestData $data): string
    {
        $key = sprintf('methods.%s.requestNormalizer', $this->callTouchMethod);
        $normalize = Config::get($key);

        if (!is_subclass_of($normalize, NormalizerInterface::class)) {
            throw new SystemException('Request normalizer not found');
        }

        return (new $normalize)->normalize($data);
    }
}