<?php
namespace Custom\Mrc\Block;


class AllModule extends \Magento\Framework\View\Element\Template
{
    protected $helper;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Custom\Mrc\Helper\Data $helper,
       array $data = []

    ){
        $this->helper = $helper;
       parent::__construct($context, $data);

    }
    /**
     * getContentForDisplay
     * @return array
     */
    public function getContentForDisplay()
    {
        return $this->helper->getCustomModules();

    }
}
