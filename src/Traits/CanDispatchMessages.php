<?php

namespace Milos\MailerSdk\Traits;

use Milos\MailerSdk\Exception\MailerException;
use Milos\MailerSdk\Mailer;
use PhpAmqpLib\Message\AMQPMessage;

trait CanDispatchMessages
{
    public function dispatch(Mailer $sdk, mixed $payload): void
    {
        $client = $sdk->getAmqpClient();

        if (!$client) {
            throw new MailerException('You need to set up an AmqpClient object in order to dispatch messages!');
        }

        $message = new AMQPMessage(json_encode($payload));
        $client->getChannel()->basic_publish($message, $client->getExchange(), $client->getRoutingKey());
    }
}