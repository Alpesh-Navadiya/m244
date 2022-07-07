<?php
namespace Custom\Mrc\Model;
use Magento\Framework\Model\AbstractModel;

class Hero extends AbstractModel implements \Custom\Mrc\Api\Data\HeroDataInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'jeff_hero_list';

    protected function _construct()
    {
        $this->_init(ResourceModel\Hero::class);
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    public function setTitle($title)
    {
        $this->setData(self::TITLE, $title);
    }

    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    public function setContent($title)
    {
        $this->setData(self::CONTENT, $title);
    }

    public function getId() {
        return $this->getData(self::ID);
    }

    public function setId($id) {
        $this->setData(self::ID, $id);
        return $this;
    }


}
