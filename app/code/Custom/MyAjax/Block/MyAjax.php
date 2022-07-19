<?php

namespace Custom\MyAjax\Block;

use Custom\MyAjax\Model\ResourceModel\Contact\Collection;
use Magento\Framework\View\Element\Template;

class MyAjax extends Template
{
    protected $collection;

    public function __construct(
        Template\Context $context,
        Collection       $collection,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->collection = $collection;
    }

    /**
     * @return array|mixed|null
     */
    public function getData1()
    {
        return $this->collection;
    }
}
