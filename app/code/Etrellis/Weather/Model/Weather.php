<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Model;

use Etrellis\Weather\Api\Data\WeatherInterface;
use Magento\Framework\Model\AbstractModel;

class Weather extends AbstractModel implements WeatherInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Etrellis\Weather\Model\ResourceModel\Weather::class);
    }

    /**
     * @inheritDoc
     */
    public function getWeatherId()
    {
        return $this->getData(self::WEATHER_ID);
    }

    /**
     * @inheritDoc
     */
    public function setWeatherId($weatherId)
    {
        return $this->setData(self::WEATHER_ID, $weatherId);
    }

    /**
     * @inheritDoc
     */
    public function getTemp()
    {
        return $this->getData(self::TEMP);
    }

    /**
     * @inheritDoc
     */
    public function setTemp($temp)
    {
        return $this->setData(self::TEMP, $temp);
    }

    /**
     * @inheritDoc
     */
    public function getTempMin()
    {
        return $this->getData(self::TEMP_MIN);
    }

    /**
     * @inheritDoc
     */
    public function setTempMin($tempMin)
    {
        return $this->setData(self::TEMP_MIN, $tempMin);
    }

    /**
     * @inheritDoc
     */
    public function getTempMax()
    {
        return $this->getData(self::TEMP_MAX);
    }

    /**
     * @inheritDoc
     */
    public function setTempMax($tempMax)
    {
        return $this->setData(self::TEMP_MAX, $tempMax);
    }

    /**
     * @inheritDoc
     */
    public function getPressure()
    {
        return $this->getData(self::PRESSURE);
    }

    /**
     * @inheritDoc
     */
    public function setPressure($pressure)
    {
        return $this->setData(self::PRESSURE, $pressure);
    }

    /**
     * @inheritDoc
     */
    public function getHumidity()
    {
        return $this->getData(self::HUMIDITY);
    }

    /**
     * @inheritDoc
     */
    public function setHumidity($humidity)
    {
        return $this->setData(self::HUMIDITY, $humidity);
    }

    /**
     * @inheritDoc
     */
    public function getSpeed()
    {
        return $this->getData(self::SPEED);
    }

    /**
     * @inheritDoc
     */
    public function setSpeed($speed)
    {
        return $this->setData(self::SPEED, $speed);
    }

    /**
     * @inheritDoc
     */
    public function getDeg()
    {
        return $this->getData(self::DEG);
    }

    /**
     * @inheritDoc
     */
    public function setDeg($deg)
    {
        return $this->setData(self::DEG, $deg);
    }

    /**
     * @inheritDoc
     */
    public function getTimezone()
    {
        return $this->getData(self::TIMEZONE);
    }

    /**
     * @inheritDoc
     */
    public function setTimezone($timezone)
    {
        return $this->setData(self::TIMEZONE, $timezone);
    }

    /**
     * @inheritDoc
     */
    public function getDattime()
    {
        return $this->getData(self::DATTIME);
    }

    /**
     * @inheritDoc
     */
    public function setDattime($dattime)
    {
        return $this->setData(self::DATTIME, $dattime);
    }
}

