<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Etrellis\Weather\Model\ResourceModel\Weather;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'weather_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Etrellis\Weather\Model\Weather::class,
            \Etrellis\Weather\Model\ResourceModel\Weather::class
        );
    }
}

