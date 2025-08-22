<?php

namespace Milos\MailerSdk\Resources;

use Milos\MailerSdk\Mailer;
use Milos\MailerSdk\Traits\CanMakeRequests;

class Email
{
    use CanMakeRequests;

    public function __construct(
        private Mailer $sdk
    ) {}


}