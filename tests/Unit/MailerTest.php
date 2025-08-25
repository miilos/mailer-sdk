<?php

use Milos\MailerSdk\Core\ApiClient;
use Milos\MailerSdk\Dtos\EmailDtoBuilder;
use Milos\MailerSdk\Exception\MailerException;
use Milos\MailerSdk\Mailer;
use Milos\MailerSdk\Resources\Email;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    public function testCreatesObjectWithDefaults(): void
    {
        $mailer = new Mailer();

        $this->assertInstanceOf(Mailer::class, $mailer);
        $this->assertInstanceOf(ApiClient::class, $mailer->getApiClient());
        $this->assertSame('http://localhost:8000/api', $mailer->getBaseUri());
    }

    public function testReturnsEmailObject(): void
    {
        $mailer = new Mailer();

        $this->assertInstanceOf(Email::class, $mailer->emails());
    }

    public function testThrowsExceptionWhenNoAmqpClient(): void
    {
        $mailer = new Mailer();

        $emailDto = (new EmailDtoBuilder())
            ->subject('test')
            ->from('milos@gmail.com')
            ->to(['test@gmail.com'])
            ->body('test body')
            ->getEmail();

        $this->expectException(MailerException::class);
        $mailer->emails()->sendAsMessage($emailDto);
    }
}