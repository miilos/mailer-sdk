<?php

namespace Milos\MailerSdk\Resources;

use Milos\MailerSdk\Dtos\EmailDto;
use Milos\MailerSdk\Mailer;
use Milos\MailerSdk\Traits\CanDispatchMessages;
use Milos\MailerSdk\Traits\CanMakeRequests;
use Psr\Http\Message\ResponseInterface;

class Email
{
    use CanMakeRequests;
    use CanDispatchMessages;

    public function __construct(
        private Mailer $sdk
    ) {}

    public function send(EmailDto $email): ResponseInterface
    {
        // the CanMakeRequests trait contains a generic post method that takes in the request body as an array
        $reqBody = $email->toArray();
        return $this->post($this->sdk, '/send', $reqBody);
    }

    public function sendAsMessage(EmailDto $email): void
    {
        $this->dispatch($this->sdk, $email->toArray());
    }
}