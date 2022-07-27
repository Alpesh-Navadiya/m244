<?php

namespace Custom\Repo\Controller\Index;

use Exception;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\View\Result\PageFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Save extends Action
{
    protected $pageFactory;

    protected $uploaderFactory;
    protected $adapterFactory;
    protected $filesystem;

    private $allcustomFactory;
    private $allcustomRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        Filesystem $filesystem,
        \Custom\Repo\Model\CustomFactory $allcustomFactory = null,
        \Custom\Repo\Api\CustomRepositoryInterface $allcustomRepository = null
    ) {
        $this->pageFactory = $pageFactory;

        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;

        $this->allcustomFactory = $allcustomFactory ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Custom\Repo\Model\CustomFactory::class);
        $this->allcustomRepository = $allcustomRepository ?: \Magento\Framework\App\ObjectManager::getInstance()->get(\Custom\Repo\Api\CustomRepositoryInterface::class);

        return parent::__construct($context);
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
                $uploaderFactories = $this->uploaderFactory->create(['fileId' => 'image']);
                $uploaderFactories->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactories->addValidateCallback('custom_image_upload', $imageAdapter, 'validateUploadFile');
                $uploaderFactories->setAllowRenameFiles(true);
                $uploaderFactories->setFilesDispersion(true);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('Alpesh/userform');
                $result = $uploaderFactories->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(__('File cannot be saved to path: $1', $destinationPath));
                }

                $imagePath = 'Alpesh/userform' . $result['file'];
                $data['image'] = $imagePath;
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo $msg = "File not found!";
        }
        $postData = $this->allcustomFactory->create();
        $postData->setData($data);
        if (isset($data['editId'])) {
            $id = $data['editId'];
        } else {
            $id = 0;
        }
        if ($id != 0) {
            $postData->load($id);
            $postData->addData($data);
            $postData->setId($id);
            try {
                $this->allcustomRepository->save($postData);
            } catch (\Exception $e) {
                $this->messageManager->addException($e, $e->getMessage());
            }
        } else {
            try {
                $this->allcustomRepository->save($postData);
            } catch (\Exception $e) {
                $this->messageManager->addException($e, $e->getMessage());
            }
        }

        // $test->setData($data);

        if ($postData->save()) {
            //$this->messageManager->addSuccessMessage(__($test['fname']. ' ! You saved the data.'));
            //$this->messageManager->addSuccessMessage(__('You saved the data.'));
            echo $res = "1"; //echo "1";
        } else {
            //$this->messageManager->addErrorMessage(__('Data was not saved.'));
            echo $res = false; //echo "0";
        }
    }
}
