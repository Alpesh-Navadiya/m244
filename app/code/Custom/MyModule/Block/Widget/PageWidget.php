<?php
/**
 * Created By : Rohan Hapani
 */
namespace custom\MyModule\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class PageWidget extends Template implements BlockInterface
{
    protected $_template = "custom_MyModule::widget/page_widget.phtml";
}
