<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Api;

interface WeatherManagementInterface
{

    /**
     * GET for weather api
     * @return string
     */
    public function getWeather();
}

