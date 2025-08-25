<?php

namespace Integration;

use Milos\MailerSdk\Core\AmqpClient;
use Milos\MailerSdk\Dtos\EmailDtoBuilder;
use Milos\MailerSdk\Mailer;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    public function testSendEmails(): void
    {
        $mailer = new Mailer();

        $email = (new EmailDtoBuilder())
            ->subject('sdk api')
            ->from('milos@gmail.com')
            ->to(['testAddr@gmail.com'])
            ->body('hi from the sdk {{ var }}')
            ->variables([
                'var' => 'variable'
            ])
            ->getEmail();

        $res = $mailer->emails()->send($email);

        $this->assertSame(200, $res->getStatusCode());
    }

    public function testDispatchesMessagesToQueue(): void
    {
        $amqpClient = new AMQPClient(
            host: 'localhost',
            port: 5674,
            user: 'guest',
            password: 'guest',
            exchange: 'sdk_messages'
        );

        $mailer = new Mailer([
            'amqp_client' => $amqpClient,
        ]);

        $email = (new EmailDtoBuilder())
            ->subject('sdk amqp')
            ->from('milos@gmail.com')
            ->to(['testAddr@gmail.com'])
            ->body('hi from the sdk {{ var }}')
            ->variables([
                'var' => 'variable'
            ])
            ->getEmail();

        $mailer->emails()->sendAsMessage($email);
    }
}