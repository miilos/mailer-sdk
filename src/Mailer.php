<?php

namespace Milos\MailerSdk;

use Milos\MailerSdk\Core\ClientBuilder;

class Mailer
{
    private ClientBuilder $clientBuilder;
    private string $baseUri;

    public function __construct(array $options = [])
    {
        $this->clientBuilder = $options['client_builder'] ?: new ClientBuilder();
        $this->baseUri = $options['base_uri'] ?? 'http://localhost:8000';
    }

    public function getClientBuilder(): ClientBuilder
    {
        return $this->clientBuilder;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }
}