<?php

namespace Custom\Repo\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Custom\Repo\Api\Data\CustomInterface;

/**
 * Interface CustomManagementInterface
 * @package Custom\Repo\Api
 */
interface CustomRepositoryInterface
{
    /**
     * @param int $id
     * @return \Custom\Repo\Api\Data\CustomInterface
     */
    public function getById($id);

    /**
     * @param \Custom\Repo\Api\Data\CustomInterface $vimagento
     * @return \Custom\Repo\Api\Data\CustomInterface
     */
    public function save(CustomInterface $vimagento);

    /**
     * @param int $id
     * @return bool
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Custom\Repo\Api\Data\CustomSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
