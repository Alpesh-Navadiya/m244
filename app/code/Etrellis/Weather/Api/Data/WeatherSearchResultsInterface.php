<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Api\Data;

interface WeatherSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get weather list.
     * @return \Etrellis\Weather\Api\Data\WeatherInterface[]
     */
    public function getItems();

    /**
     * Set temp list.
     * @param \Etrellis\Weather\Api\Data\WeatherInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

