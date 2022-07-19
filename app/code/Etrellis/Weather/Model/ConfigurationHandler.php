<?php
/**
 * Class ConfigurationHandler to handle all Etrellis_Weather module Configurations.
 **/

namespace Etrellis\Weather\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ConfigurationHandler to handle all Etrellis_Weather module Configurations.
 **/
class ConfigurationHandler
{

    /**
     * Weather API Key path
     */
    const WEATHER_API_KEY = "weather/options/api_key";

    /**
     * Weather City ID path
     */
    const WEATHER_CITY_ID = "weather/options/city_id";

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(ScopeConfigInterface $scopeConfig)
    {
        $this->scopeConfig = $scopeConfig;
    }

    public function getWeatherAPIKey($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::WEATHER_API_KEY,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }

    public function getWeatherCityId($storeId = null)
    {
        return $this->scopeConfig->getValue(
            self::WEATHER_CITY_ID,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
