<?php

namespace Integration;

use Milos\MailerSdk\Dtos\EmailDtoBuilder;
use Milos\MailerSdk\Mailer;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    public function testSendEmails(): void
    {
        $mailer = new Mailer();

        $email = (new EmailDtoBuilder())
            ->subject('testing sdk')
            ->from('milos@gmail.com')
            ->to(['test@gmail.com'])
            ->body('hi from the sdk {{ var }}')
            ->variables([
                'var' => 'variable'
            ])
            ->getEmail();

        $res = $mailer->emails()->send($email);

        $this->assertSame(200, $res->getStatusCode());
    }
}