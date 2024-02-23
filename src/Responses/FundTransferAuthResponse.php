<?php

// Copyright (C) 2023 Ivan Stasiuk <ivan@stasi.uk>.
//
// This Source Code Form is subject to the terms of the Mozilla Public
// License, v. 2.0. If a copy of the MPL was not distributed with this file,
// You can obtain one at https://mozilla.org/MPL/2.0/.

namespace BrokeYourBike\NinePSB\Responses;

use BrokeYourBike\DataTransferObject\JsonResponse;

/**
 * @author Ivan Stasiuk <ivan@stasi.uk>
 */
class FundTransferAuthResponse extends JsonResponse
{
    public string $code;
    public string $message;
    public ?string $access_token;
    public ?int $expires_in;
}

