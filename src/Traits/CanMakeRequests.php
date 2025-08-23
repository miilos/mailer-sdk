<?php

namespace Milos\MailerSdk\Traits;

use Milos\MailerSdk\Mailer;
use Psr\Http\Message\ResponseInterface;

trait CanMakeRequests
{
    public function post(Mailer $sdk, string $endpoint, array $data): ResponseInterface
    {
        $client = $sdk->getClientBuilder();
        $baseUri = $sdk->getBaseUri();

        $url = $baseUri . '/' . ltrim($endpoint, '/');
        $body = $client->getStreamFactory()->createStream(json_encode($data));

        $request = $client->getRequestFactory()->createRequest('POST', $url)
            ->withBody($body)
            ->withHeader('Content-Type', 'application/json');

        return $client->getHttpClient()->sendRequest($request);
    }
}