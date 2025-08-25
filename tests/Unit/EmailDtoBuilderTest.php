<?php

use Milos\MailerSdk\Dtos\EmailDto;
use Milos\MailerSdk\Dtos\EmailDtoBuilder;
use Milos\MailerSdk\Exception\MailerException;
use PHPUnit\Framework\TestCase;

class EmailDtoBuilderTest extends TestCase
{
    public function testBuildsEmailDtoObject(): void
    {
        $emailDto = (new EmailDtoBuilder())
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
        $emailDto = (new EmailDtoBuilder())
            ->subject('test')
            ->to(['test@gmail.com'])
            ->body('test body')
            ->getEmail();
    }
}