<?php

use Milos\MailerSdk\Core\AmqpClient;
use Milos\MailerSdk\Core\ApiClient;
use Milos\MailerSdk\Dtos\EmailDto;
use Milos\MailerSdk\Dtos\EmailBuilder;
use Milos\MailerSdk\Exception\MailerException;
use Milos\MailerSdk\Mailer;
use Milos\MailerSdk\Resources\Email;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    public function testCreatesObjectWithDefaults(): void
    {
        $mailer = new Mailer([
            'base_uri' => 'http://localhost:8000'
        ]);

        $this->assertInstanceOf(Mailer::class, $mailer);
        $this->assertInstanceOf(ApiClient::class, $mailer->getApiClient());
        $this->assertSame('http://localhost:8000/api', $mailer->getBaseUri());
    }

    public function testReturnsEmailObject(): void
    {
        $mailer = new Mailer([
            'base_uri' => 'http://localhost:8000'
        ]);

        $this->assertInstanceOf(Email::class, $mailer->emails());
    }

    public function testThrowsExceptionWhenNoBaseUri(): void
    {
        $this->expectException(MailerException::class);
        $mailer = new Mailer();
    }

    public function testThrowsExceptionWhenNoAmqpClient(): void
    {
        $mailer = new Mailer([
            'base_uri' => 'http://localhost:8000'
        ]);

        $this->expectException(MailerException::class);
        $mailer->emails()->sendAsMessage(new EmailDto());
    }

    public function testThrowsExceptionWhenNoExchangeName(): void
    {
        $amqpClient = new AMQPClient(
            host: 'localhost',
            port: 5674,
            user: 'guest',
            password: 'guest',
        );

        $mailer = new Mailer([
            'base_uri' => 'http://localhost:8000',
            'amqp_client' => $amqpClient
        ]);

        $this->expectException(MailerException::class);
        $mailer->emails()->sendAsMessage(new EmailDto());
    }
}