<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface WeatherRepositoryInterface
{

    /**
     * Save weather
     * @param \Etrellis\Weather\Api\Data\WeatherInterface $weather
     * @return \Etrellis\Weather\Api\Data\WeatherInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Etrellis\Weather\Api\Data\WeatherInterface $weather
    );

    /**
     * Retrieve weather
     * @param string $weatherId
     * @return \Etrellis\Weather\Api\Data\WeatherInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($weatherId);

    /**
     * Retrieve weather matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Etrellis\Weather\Api\Data\WeatherSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete weather
     * @param \Etrellis\Weather\Api\Data\WeatherInterface $weather
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Etrellis\Weather\Api\Data\WeatherInterface $weather
    );

    /**
     * Delete weather by ID
     * @param string $weatherId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($weatherId);
}

