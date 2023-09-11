<?php

// Copyright (C) 2023 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\NinePSB\Tests;

use BrokeYourBike\ResolveUri\ResolveUriTrait;
use BrokeYourBike\NinePSB\Interfaces\FundTransferConfigInterface;
use BrokeYourBike\NinePSB\FundTransferClient;
use BrokeYourBike\HttpClient\HttpClientTrait;
use BrokeYourBike\HttpClient\HttpClientInterface;
use BrokeYourBike\HasSourceModel\HasSourceModelTrait;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class FundTransferClientTest extends TestCase
{
    /** @test */
    public function it_implemets_http_client_interface(): void
    {
        /** @var FundTransferConfigInterface */
        $mockedConfig = $this->getMockBuilder(FundTransferConfigInterface::class)->getMock();

        /** @var \GuzzleHttp\ClientInterface */
        $mockedHttpClient = $this->getMockBuilder(\GuzzleHttp\ClientInterface::class)->getMock();

        /** @var \Psr\SimpleCache\CacheInterface */
        $mockedCache = $this->getMockBuilder(\Psr\SimpleCache\CacheInterface::class)->getMock();

        $client = new FundTransferClient($mockedConfig, $mockedHttpClient, $mockedCache);

        $this->assertInstanceOf(HttpClientInterface::class, $client);
        $this->assertSame($mockedConfig, $client->getConfig());
        $this->assertSame($mockedCache, $client->getCache());
    }

    /** @test */
    public function it_uses_http_client_trait(): void
    {
        $usedTraits = class_uses(FundTransferClient::class);

        $this->assertArrayHasKey(HttpClientTrait::class, $usedTraits);
    }

    /** @test */
    public function it_uses_resolve_uri_trait(): void
    {
        $usedTraits = class_uses(FundTransferClient::class);

        $this->assertArrayHasKey(ResolveUriTrait::class, $usedTraits);
    }

    /** @test */
    public function it_uses_has_source_model_trait(): void
    {
        $usedTraits = class_uses(FundTransferClient::class);

        $this->assertArrayHasKey(HasSourceModelTrait::class, $usedTraits);
    }
}
