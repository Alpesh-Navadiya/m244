<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Api\Data;

interface WeatherInterface
{

    const WEATHER_ID = 'weather_id';
    const SPEED = 'speed';
    const PRESSURE = 'pressure';
    const TEMP_MAX = 'temp_max';
    const TEMP_MIN = 'temp_min';
    const TIMEZONE = 'timezone';
    const TEMP = 'temp';
    const HUMIDITY = 'humidity';
    const DATTIME = 'dattime';
    const DEG = 'deg';

    /**
     * Get weather_id
     * @return string|null
     */
    public function getWeatherId();

    /**
     * Set weather_id
     * @param string $weatherId
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setWeatherId($weatherId);

    /**
     * Get temp
     * @return string|null
     */
    public function getTemp();

    /**
     * Set temp
     * @param string $temp
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setTemp($temp);

    /**
     * Get temp_min
     * @return string|null
     */
    public function getTempMin();

    /**
     * Set temp_min
     * @param string $tempMin
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setTempMin($tempMin);

    /**
     * Get temp_max
     * @return string|null
     */
    public function getTempMax();

    /**
     * Set temp_max
     * @param string $tempMax
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setTempMax($tempMax);

    /**
     * Get pressure
     * @return string|null
     */
    public function getPressure();

    /**
     * Set pressure
     * @param string $pressure
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setPressure($pressure);

    /**
     * Get humidity
     * @return string|null
     */
    public function getHumidity();

    /**
     * Set humidity
     * @param string $humidity
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setHumidity($humidity);

    /**
     * Get speed
     * @return string|null
     */
    public function getSpeed();

    /**
     * Set speed
     * @param string $speed
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setSpeed($speed);

    /**
     * Get deg
     * @return string|null
     */
    public function getDeg();

    /**
     * Set deg
     * @param string $deg
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setDeg($deg);

    /**
     * Get timezone
     * @return string|null
     */
    public function getTimezone();

    /**
     * Set timezone
     * @param string $timezone
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setTimezone($timezone);

    /**
     * Get dattime
     * @return string|null
     */
    public function getDattime();

    /**
     * Set dattime
     * @param string $dattime
     * @return \Etrellis\Weather\Weather\Api\Data\WeatherInterface
     */
    public function setDattime($dattime);
}

