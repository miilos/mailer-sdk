<?php

use Milos\MailerSdk\Dtos\EmailDto;
use Milos\MailerSdk\Dtos\EmailDtoBuilder;
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
}