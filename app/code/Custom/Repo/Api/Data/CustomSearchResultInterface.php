<?php

namespace Custom\Repo\Api\Data;

/**
 * Interface CustomSearchResultInterface
 * @package ViMagento\CustomApi\Api\Data
 */
interface CustomSearchResultInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    /**
     * @return \Custom\Repo\Api\Data\CustomInterface[]
     */
    public function getItems();

    /**
     * @param \Custom\Repo\Api\Data\CustomInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
