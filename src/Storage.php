<?php

namespace Vimqu\Vimqu;

use Vimqu\Vimqu\Enums\ClientEnum;
use Vimqu\Vimqu\Exceptions\InvalidTokenException;
use Vimqu\Vimqu\Exceptions\UnexpectedException;
use Vimqu\Vimqu\Exceptions\InvalidRequestPayloadException;
use GuzzleHttp\Exception\GuzzleException;

class Storage
{
    use HasClient;

    /**
     * @throws InvalidTokenException
     * @throws UnexpectedException
     * @throws InvalidRequestPayloadException
     * @throws GuzzleException
     * @return array
     */
    public function all(): ?array
    {
        $response = $this->getClient()->request('GET', ClientEnum::STORAGE_ENDPOINT->url());

        $this->validateStatus($response);

        $storages = json_decode($response->getBody()->getContents(), true);

        return $storages['data'] ?? null;
    }
}