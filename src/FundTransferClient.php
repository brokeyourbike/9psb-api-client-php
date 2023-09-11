<?php

// Copyright (C) 2023 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\NinePSB;

use Psr\SimpleCache\CacheInterface;
use GuzzleHttp\ClientInterface;
use BrokeYourBike\ResolveUri\ResolveUriTrait;
use BrokeYourBike\NinePSB\Responses\FundTransferAuthResponse;
use BrokeYourBike\NinePSB\Interfaces\FundTransferConfigInterface;
use BrokeYourBike\HttpEnums\HttpMethodEnum;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;
use BrokeYourBike\HasSourceModel\HasSourceModelTrait;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class FundTransferClient implements HttpClientInterface
{
    use HttpClientTrait;
    use ResolveUriTrait;
    use HasSourceModelTrait;

    private FundTransferConfigInterface $config;
    private CacheInterface $cache;

    public function __construct(FundTransferConfigInterface $config, ClientInterface $httpClient, CacheInterface $cache)
    {
        $this->config = $config;
        $this->httpClient = $httpClient;
        $this->cache = $cache;
    }

    public function getConfig(): FundTransferConfigInterface
    {
        return $this->config;
    }

    public function getCache(): CacheInterface
    {
        return $this->cache;
    }

    public function authTokenCacheKey(): string
    {
        return get_class($this) . ':authToken:';
    }

    public function getAuthToken(): ?string
    {
        if ($this->cache->has($this->authTokenCacheKey())) {
            $cachedToken = $this->cache->get($this->authTokenCacheKey());

            if (is_string($cachedToken)) {
                return $cachedToken;
            }
        }

        $response = $this->fetchAuthTokenRaw();

        if ($response->access_token === null) {
            return $response->access_token;
        }

        $this->cache->set(
            $this->authTokenCacheKey(),
            $response->access_token,
            $response->expires_in - 60
        );

        return $response->access_token;
    }

    public function fetchAuthTokenRaw(): FundTransferAuthResponse
    {
        $options = [
            \GuzzleHttp\RequestOptions::HEADERS => [
                'Accept' => 'application/json',
            ],
            \GuzzleHttp\RequestOptions::JSON => [
                'publickey' => $this->config->getPublicKey(),
                'privatekey' => $this->config->getPrivateKey(),
            ],
        ];

        $uri = (string) $this->resolveUriFor($this->config->getUrl(), 'authenticate');
        $response = $this->httpClient->request(HttpMethodEnum::POST->value, $uri, $options);
        return new FundTransferAuthResponse($response);
    }
}
