<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Cron;

use Etrellis\Weather\Model\ConfigurationHandler;
use Etrellis\Weather\Model\WeatherFactory;
use Exception;
use Magento\Framework\HTTP\Client\Curl;
use Magento\Framework\Serialize\Serializer\Json;
use Psr\Log\LoggerInterface;

class WeatherCheck
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
    )
    {
        $this->logger = $logger;
        $this->weatherFactory = $weatherFactory;
        $this->curl = $curl;
        $this->json = $json;
        $this->configurationHandler = $configurationHandler;
    }

    /**
     * Execute the cron
     *
     * @return void
     * @throws Exception
     */
    public function execute()
    {
            $apiKey = $this->configurationHandler->getWeatherAPIKey();
            $cityId = $this->configurationHandler->getWeatherCityId();
            $openWeatherApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" . $cityId . "&lang=en&units=metric&APPID=" . $apiKey;

            $this->curl->get($openWeatherApiUrl);

            //response will contain the output in form of JSON string
            $response = $this->curl->getBody();
            $jsonDecode = $this->json->unserialize($response);
            $this->logger->info(print_r($jsonDecode, true));
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

            $model = $this->weatherFactory->create();
            $model->addData([
                "temp" => $temp,
                "temp_min" => $temp_min,
                "temp_max" => $temp_max,
                "pressure" => $pressure,
                "humidity" => $humidity,
                "speed" => $speed,
                "deg" => $deg,
                "timezone" => $timezone
            ]);
            $saveData = $model->save();
            $this->logger->info("Cronjob weatherCheck is executed.");
    }
}
