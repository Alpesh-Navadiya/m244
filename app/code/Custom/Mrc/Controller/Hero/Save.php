<?php

namespace Custom\Mrc\Controller\Hero;

use Custom\Mrc\Model\Hero;
use Custom\Mrc\Model\ResourceModel\Hero as HeroResourceModel;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;

class Save extends Action
{
    /**
     * @var Hero
     */
    private $hero;
    /**
     * @var HeroResourceModel
     */
    private $heroResourceModel;

    /**
     * Add constructor.
     * @param Context $context
     * @param Hero $hero
     * @param HeroResourceModel $heroResourceModel
     */
    public function __construct(
        Context $context,
        Hero $hero,
        HeroResourceModel $heroResourceModel
    ) {
        $this->hero = $hero;
        $this->heroResourceModel = $heroResourceModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $params = $this->getRequest()->getParams();
        $hero = $this->hero->setData($params);//TODO: Challenge Modify here to support the edit save functionality
        
        try {
            $this->heroResourceModel->save($hero);
            if(isset($params['id'])){
                $this->messageManager->addSuccessMessage(__("Successfully updated the Hero %1", $params['title']));
            } else {
                $this->messageManager->addSuccessMessage(__("Successfully added the Hero %1", $params['title']));
            }    
        } catch (\Exception $e) {
            dd($e);
        }
        /* Redirect back to hero display page */
        $redirect = $this->resultRedirectFactory->create();
        $redirect->setPath('superhero');
        return $redirect;
    }
}
