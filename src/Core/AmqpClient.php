<?php

namespace Milos\MailerSdk\Core;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class AmqpClient
{
    private AMQPStreamConnection $connection;
    private AMQPChannel $channel;
    private ?string $exchange;
    private ?string $routingKey;

    public function __construct(
        string $host,
        string $port,
        string $user,
        string $password,
        ?string $exchange = null,
        ?string $routingKey = null
    )
    {
        $this->connection = new AMQPStreamConnection($host, $port, $user, $password);
        $this->channel = $this->connection->channel();

        $this->exchange = $exchange;
        $this->routingKey = $routingKey;
    }

    public function __destruct()
    {
        $this->channel->close();
        $this->connection->close();
    }

    public function getChannel(): AMQPChannel
    {
        return $this->channel;
    }

    public function getExchange(): ?string
    {
        return $this->exchange;
    }

    public function getRoutingKey(): ?string
    {
        return $this->routingKey;
    }
}