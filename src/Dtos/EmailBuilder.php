<?php

namespace Milos\MailerSdk\Dtos;

use Milos\MailerSdk\Exception\MailerException;

class EmailBuilder
{
    private EmailDto $email;

    public function __construct()
    {
        $this->email = new EmailDto();
    }

    public function subject(string $subject): EmailBuilder
    {
        $this->email->setSubject($subject);

        return $this;
    }

    public function from(string $from): EmailBuilder
    {
        $this->email->setFrom($from);

        return $this;
    }

    public function to(array $to): EmailBuilder
    {
        $this->email->setTo($to);

        return $this;
    }

    public function cc(array $cc): EmailBuilder
    {
        $this->email->setCc($cc);

        return $this;
    }

    public function bcc(array $bcc): EmailBuilder
    {
        $this->email->setBcc($bcc);

        return $this;
    }

    public function body(string $body): EmailBuilder
    {
        $this->email->setBody($body);

        return $this;
    }

    public function bodyTemplate(string $bodyTemplate): EmailBuilder
    {
        $this->email->setBodyTemplate($bodyTemplate);

        return $this;
    }

    public function emailTemplate(string $emailTemplate): EmailBuilder
    {
        $this->email->setEmailTemplate($emailTemplate);

        return $this;
    }

    public function variables(array $variables): EmailBuilder
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
        if (!$this->email->getSubject() && !$this->email->getEmailTemplate()) {
            throw new MailerException('Email subject cannot be empty!');
        }

        if (!$this->email->getFrom() && !$this->email->getEmailTemplate()) {
            throw new MailerException('Email from address cannot be empty!');
        }

        if (!$this->email->getTo() && !$this->email->getEmailTemplate()) {
            throw new MailerException('Email must be addressed to at least one recipient!');
        }

        if (!$this->email->getBody() && !$this->email->getBodyTemplate() && !$this->email->getEmailTemplate()) {
            throw new MailerException('You must either specify a body for an email, use a body template, or use an email template with a body!');
        }
    }
}