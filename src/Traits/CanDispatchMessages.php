<?php

namespace Milos\MailerSdk\Traits;

use Milos\MailerSdk\Exception\MailerException;
use Milos\MailerSdk\Mailer;
use PhpAmqpLib\Message\AMQPMessage;

trait CanDispatchMessages
{
    public function dispatch(Mailer $sdk, mixed $payload, ?string $exchange = null, ?string $routingKey = null): void
    {
        $client = $sdk->getAmqpClient();

        if (!$client) {
            throw new MailerException('You need to set up an AmqpClient object in order to dispatch messages!');
        }

        $exchange = $exchange ?? $client->getExchange() ?? null;
        $routingKey = $routingKey ?? $client->getRoutingKey() ?? null;

        // for fanout queues a routing key wouldn't be passed in,
        // so there's no check to see if the routing key is present
        if (!$exchange) {
            throw new MailerException('Missing exchange name!');
        }

        $message = new AMQPMessage(json_encode($payload));
        $client->getChannel()->basic_publish($message, $exchange, $routingKey);
    }
}