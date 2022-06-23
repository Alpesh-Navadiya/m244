<?php

namespace Custom\Repository\Controller\Adminhtml\Allnews;

use Magento\Backend\App\Action;
use Custom\Repository\Model\Allnews;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var \Custom\Repository\Model\AllnewsFactory
     */
    private $allnewsFactory;

    /**
     * @var \Custom\Repository\Api\AllnewsRepositoryInterface
     */
    private $allnewsRepository;

    /**
     * @param Action\Context $context
     * @param DataPersistorInterface $dataPersistor
     * @param \Custom\Repository\Model\AllnewsFactory $allnewsFactory
     * @param \Custom\Repository\Api\AllnewsRepositoryInterface $allnewsRepository
     */
    public function __construct(
        Action\Context $context,
        DataPersistorInterface $dataPersistor,
        \Custom\Repository\Model\AllnewsFactory $allnewsFactory = null,
        \Custom\Repository\Api\AllnewsRepositoryInterface $allnewsRepository = null
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->allnewsFactory = $allnewsFactory
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Custom\Repository\Model\AllnewsFactory::class);
        $this->allnewsRepository = $allnewsRepository
            ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Custom\Repository\Api\AllnewsRepositoryInterface::class);
        parent::__construct($context);
    }
	
	/**
     * Authorization level
     *
     * @see _isAllowed()
     */
	

    /**
     * Save action
     *
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            if (isset($data['status']) && $data['status'] === 'true') {
                $data['status'] = Allnews::STATUS_ENABLED;
            }
            if (empty($data['id'])) {
                $data['id'] = null;
            }

            /** @var \Custom\Repository\Model\Allnews $model */
            $model = $this->allnewsFactory->create();

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                try {
                    $model = $this->allnewsRepository->getById($id);
                } catch (LocalizedException $e) {
                    $this->messageManager->addErrorMessage(__('This news no longer exists.'));
                    return $resultRedirect->setPath('*/*/');
                }
            }

            $model->setData($data);

            $this->_eventManager->dispatch(
                'news_allnews_prepare_save',
                ['allnews' => $model, 'request' => $this->getRequest()]
            );

            try {
                $this->allnewsRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the news.'));
                $this->dataPersistor->clear('news_allnews');
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addExceptionMessage($e->getPrevious() ?:$e);
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the news.'));
            }

            $this->dataPersistor->set('news_allnews', $data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
