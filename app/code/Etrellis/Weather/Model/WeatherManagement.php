<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Model;

use Etrellis\Weather\Api\WeatherManagementInterface;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;

class WeatherManagement implements WeatherManagementInterface
{
    /**
     * @var Curl
     */
    protected $logger;

    /**
     * @var WeatherFactory
     */
    protected $weatherFactory;

    /**
     * @var Curl
     */
    protected $curl;

    /**
     * @var Json
     */
    protected $json;
    /**
     * @var ConfigurationHandler
     */
    private $configurationHandler;

    /**
     * Constructor
     *
     * @param LoggerInterface $logger
     * @param WeatherFactory $weatherFactory
     * @param Curl $curl
     * @param Json $json
     * @param ConfigurationHandler $configurationHandler
     */
    public function __construct(
        LoggerInterface      $logger,
        WeatherFactory       $weatherFactory,
        Curl                 $curl,
        Json                 $json,
        ConfigurationHandler $configurationHandler
    ) {
        $this->logger = $logger;
        $this->weatherFactory = $weatherFactory;
        $this->curl = $curl;
        $this->json = $json;
        $this->configurationHandler = $configurationHandler;
    }

    /**
     * {@inheritdoc}
     */
    public function getWeather()
    {
            $apiKey = $this->configurationHandler->getWeatherAPIKey();
            $cityId = $this->configurationHandler->getWeatherCityId();
            $openWeatherApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

            $this->curl->get($openWeatherApiUrl);

            //response will contain the output in form of JSON string
            $response = $this->curl->getBody();
            $jsonDecode = $this->json->unserialize($response);
            $this->logger->info(print_r($jsonDecode, true));
            $this->logger->info(print_r($apiKey, true));
            $this->logger->info(print_r($cityId, true));
            $mainData = $jsonDecode['main'];
            $windData = $jsonDecode['wind'];

            $temp = $jsonDecode['main']['temp'];
            $temp_min = $jsonDecode['main']['temp_min'];
            $temp_max = $jsonDecode['main']['temp_max'];
            $pressure = $jsonDecode['main']['pressure'];
            $humidity = $jsonDecode['main']['humidity'];
            $speed = $jsonDecode['wind']['speed'];
            $deg = $jsonDecode['wind']['deg'];
            $timezone = $jsonDecode['timezone'];
            $datetime = $jsonDecode['timezone'];
            return $response;
    }
}
