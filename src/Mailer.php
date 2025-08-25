<?php

namespace Milos\MailerSdk;

use Milos\MailerSdk\Core\AmqpClient;
use Milos\MailerSdk\Core\ApiClient;
use Milos\MailerSdk\Resources\Email;

class Mailer
{
    private ApiClient $apiClient;
    private string $baseUri;
    private ?AmqpClient $amqpClient;

    public function __construct(array $options = [])
    {
        $this->apiClient = $options['api_client'] ?? new ApiClient();
        $this->baseUri = $options['base_uri'] ?? 'http://localhost:8000/api';
        $this->amqpClient = $options['amqp_client'] ?? null;
    }

    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }

    public function getBaseUri(): string
    {
        return $this->baseUri;
    }

    public function getAmqpClient(): ?AmqpClient
    {
        return $this->amqpClient;
    }

    public function emails(): Email
    {
        return new Email($this);
    }
}