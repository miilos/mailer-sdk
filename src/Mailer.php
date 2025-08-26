<?php

namespace Milos\MailerSdk;

use Milos\MailerSdk\Core\AmqpClient;
use Milos\MailerSdk\Core\ApiClient;
use Milos\MailerSdk\Exception\MailerException;
use Milos\MailerSdk\Resources\Email;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Mailer
{
    private ApiClient $apiClient;
    private ?string $baseUri;
    private ?AmqpClient $amqpClient;

    public function __construct(array $options = [])
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $options = $resolver->resolve($options);

        if (!$options['base_uri']) {
            throw new MailerException('The base_uri option is required!');
        }

        $this->apiClient = $options['api_client'];
        $this->baseUri = $options['base_uri'].'/api';
        $this->amqpClient = $options['amqp_client'];
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'api_client' => new ApiClient(),
            'base_uri' => null,
            'amqp_client' => null,
        ]);
    }

    public function getApiClient(): ApiClient
    {
        return $this->apiClient;
    }

    public function getBaseUri(): ?string
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