<?php

namespace Vimqu\Vimqu;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Vimqu\Vimqu\Enums\ClientEnum;
use Vimqu\Vimqu\Exceptions\InvalidRequestPayloadException;
use Vimqu\Vimqu\Exceptions\InvalidTokenException;
use Vimqu\Vimqu\Exceptions\UnexpectedException;

trait HasClient
{
    private string $token;

    public static function withToken(string $token): static
    {
        return (new static)->setToken($token);
    }

    public function setToken(string $token): static
    {
        $this->token = $token;
        return $this;
    }

    public function getClient(): Client
    {
        return new Client([
            'timeout'  => 40,
            'connect_timeout' => 10,
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$this->token,
                'User-Agent' => ClientEnum::USER_AGENT->value,
            ]
        ]);
    }

    protected function validateStatus(ResponseInterface $response): void
    {
        $responseStatusCode = $response->getStatusCode();
        if ($responseStatusCode === 401) {
            throw new InvalidTokenException;
        } elseif($responseStatusCode === 422) {
            throw new InvalidRequestPayloadException;
        } elseif(in_array($responseStatusCode, [200, 201, 301], true) === false) {
            throw new UnexpectedException;
        }
    }
}