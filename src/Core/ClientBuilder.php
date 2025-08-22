<?php

namespace Milos\MailerSdk\Core;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Symfony\Component\HttpClient\Psr18Client;

class ClientBuilder
{
    private ClientInterface $httpClient;
    private RequestFactoryInterface $requestFactory;
    private StreamFactoryInterface $streamFactory;

    public function __construct(
        ?ClientInterface         $httpClient = null,
        ?RequestFactoryInterface $requestFactory = null,
        ?StreamFactoryInterface  $streamFactory = null
    )
    {
        if (!class_exists(Psr18Client::class)) {
            throw new \RuntimeException('Symfony HTTP client not found! Please run composer require symfony/http-client.');
        }

        $this->httpClient = $httpClient ?: new Psr18Client();

        $factory = new Psr17Factory();
        $this->requestFactory = $requestFactory ?: $factory;
        $this->streamFactory = $streamFactory ?: $factory;
    }

    public function getHttpClient(): ClientInterface
    {
        return $this->httpClient;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    public function getStreamFactory(): StreamFactoryInterface
    {
        return $this->streamFactory;
    }
}