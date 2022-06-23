<?php
namespace Custom\Repository\Block\Adminhtml;

class Allnews extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_allnews';
        $this->_blockGroup = 'Custom_Repository';
        $this->_headerText = __('Manage News');

        parent::_construct();

        if ($this->_isAllowedAction('Custom_Repository::save')) {
            $this->buttonList->update('add', 'label', __('Add News'));
        } else {
            $this->buttonList->remove('add');
        }
    }

}
