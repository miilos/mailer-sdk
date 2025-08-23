<?php

namespace Milos\MailerSdk\Dtos;

class EmailDto
{
    public function __construct(
        private ?string $subject = null,
        private ?string $from = null,
        private array $to = [],
        private array $cc = [],
        private array $bcc = [],
        private ?string $body = null,
        private ?string $bodyTemplate = null,
        private ?string $emailTemplate = null,
        private array $variables = []
    ) {}

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): void
    {
        $this->subject = $subject;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(?string $from): void
    {
        $this->from = $from;
    }

    public function getTo(): array
    {
        return $this->to;
    }

    public function setTo(array $to): void
    {
        $this->to = $to;
    }

    public function getCc(): array
    {
        return $this->cc;
    }

    public function setCc(array $cc): void
    {
        $this->cc = $cc;
    }

    public function getBcc(): array
    {
        return $this->bcc;
    }

    public function setBcc(array $bcc): void
    {
        $this->bcc = $bcc;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(?string $body): void
    {
        $this->body = $body;
    }

    public function getBodyTemplate(): ?string
    {
        return $this->bodyTemplate;
    }

    public function setBodyTemplate(?string $bodyTemplate): void
    {
        $this->bodyTemplate = $bodyTemplate;
    }

    public function getEmailTemplate(): ?string
    {
        return $this->emailTemplate;
    }

    public function setEmailTemplate(?string $emailTemplate): void
    {
        $this->emailTemplate = $emailTemplate;
    }

    public function getVariables(): array
    {
        return $this->variables;
    }

    public function setVariables(array $variables): void
    {
        $this->variables = $variables;
    }

    public function toArray(): array
    {
        return [
            'subject' => $this->subject,
            'from' => $this->from,
            'to' => $this->to,
            'cc' => $this->cc,
            'bcc' => $this->bcc,
            'body' => $this->body,
            'bodyTemplate' => $this->bodyTemplate,
            'emailTemplate' => $this->emailTemplate,
            'variables' => $this->variables,
        ];
    }
}