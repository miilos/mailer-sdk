<?php

use Milos\MailerSdk\Dtos\EmailDto;
use Milos\MailerSdk\Dtos\EmailBuilder;
use Milos\MailerSdk\Exception\MailerException;
use PHPUnit\Framework\TestCase;

class EmailBuilderTest extends TestCase
{
    public function testBuildsEmailDtoObject(): void
    {
        $emailDto = (new EmailBuilder())
            ->subject('test')
            ->from('milos@gmail.com')
            ->to(['test@gmail.com'])
            ->body('test body')
            ->getEmail();

        $this->assertInstanceOf(EmailDto::class, $emailDto);
    }

    public function testThrowsExceptionOnInvalidEmail(): void
    {
        $this->expectException(MailerException::class);
        $emailDto = (new EmailBuilder())
            ->subject('test')
            ->from('milos@gmail.com')
            ->bodyTemplate('test email template')
            ->getEmail();
    }
}