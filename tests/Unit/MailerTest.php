<?php

use Milos\MailerSdk\Core\ClientBuilder;
use Milos\MailerSdk\Mailer;
use Milos\MailerSdk\Resources\Email;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    public function testCreatesObjectWithDefaults(): void
    {
        $mailer = new Mailer();

        $this->assertInstanceOf(Mailer::class, $mailer);
        $this->assertInstanceOf(ClientBuilder::class, $mailer->getClientBuilder());
        $this->assertSame('http://localhost:8000/api', $mailer->getBaseUri());
    }

    public function testReturnsEmailObject(): void
    {
        $mailer = new Mailer();

        $this->assertInstanceOf(Email::class, $mailer->emails());
    }
}