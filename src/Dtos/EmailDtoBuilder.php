<?php

namespace Milos\MailerSdk\Dtos;

use Milos\MailerSdk\Exception\MailerException;

class EmailDtoBuilder
{
    private EmailDto $email;

    public function __construct()
    {
        $this->email = new EmailDto();
    }

    public function subject(string $subject): EmailDtoBuilder
    {
        $this->email->setSubject($subject);

        return $this;
    }

    public function from(string $from): EmailDtoBuilder
    {
        $this->email->setFrom($from);

        return $this;
    }

    public function to(array $to): EmailDtoBuilder
    {
        $this->email->setTo($to);

        return $this;
    }

    public function cc(array $cc): EmailDtoBuilder
    {
        $this->email->setCc($cc);

        return $this;
    }

    public function bcc(array $bcc): EmailDtoBuilder
    {
        $this->email->setBcc($bcc);

        return $this;
    }

    public function body(string $body): EmailDtoBuilder
    {
        $this->email->setBody($body);

        return $this;
    }

    public function bodyTemplate(string $bodyTemplate): EmailDtoBuilder
    {
        $this->email->setBodyTemplate($bodyTemplate);

        return $this;
    }

    public function emailTemplate(string $emailTemplate): EmailDtoBuilder
    {
        $this->email->setEmailTemplate($emailTemplate);

        return $this;
    }

    public function variables(array $variables): EmailDtoBuilder
    {
        $this->email->setVariables($variables);

        return $this;
    }

    public function getEmail(): EmailDto
    {
        $this->validateEmail();

        return $this->email;
    }

    private function validateEmail(): void
    {
        if (!$this->email->getSubject()) {
            throw new MailerException('Email subject cannot be empty!');
        }

        if (!$this->email->getFrom()) {
            throw new MailerException('Email from address cannot be empty!');
        }

        if (!$this->email->getTo()) {
            throw new MailerException('Email must be addressed to at least one recipient!');
        }
    }
}