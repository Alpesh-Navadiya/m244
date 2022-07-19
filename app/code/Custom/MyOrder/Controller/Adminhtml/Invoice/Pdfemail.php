<?php

namespace Custom\MyOrder\Controller\Adminhtml\Invoice;

use Exception;
use Magento\Backend\App\Action;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Mail\Template\SenderResolverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Sales\Model\Order\InvoiceRepository;
use Magento\Sales\Model\Order\Pdf\Invoice;
use Magento\Sales\Model\ResourceModel\Order\Invoice\Collection;
use Magento\Store\Model\StoreManagerInterface;
use Zend\Mime\Message;
use Zend\Mime\PartFactory;
use Zend_Mime;

class Pdfemail extends Action
{
    const XML_PATH_SALES_EMAIL_INVOICE_PDF_TEMPLATE = 'sales_email/invoice/pdf_template';
    const XML_PATH_SALES_EMAIL_INVOICE_INDENTITY = 'sales_email/invoice/identity';

    /**
     * Send a PDF invoice email to a customer from backend
     *
     * @return ResultInterface
     */
    public function execute()
    {
        try {
            $invoiceId = (int)$this->getRequest()->getParam('invoice_id');
            $invoice = $this->_objectManager->get(InvoiceRepository::class)->get($invoiceId);

            $order = $invoice->getOrder();

            $storeId = $order->getStoreId();

            $customerEmail = $order->getCustomerEmail();

            $templateId = $this->_objectManager->get(ScopeConfigInterface::class)->getValue(self::XML_PATH_SALES_EMAIL_INVOICE_PDF_TEMPLATE, 'store', $storeId);

            /** @var array $from */
            $from = $this->_objectManager->get(SenderResolverInterface::class)->resolve($this->_objectManager->get(ScopeConfigInterface::class)->getValue(self::XML_PATH_SALES_EMAIL_INVOICE_INDENTITY, 'store', $storeId), $storeId);

            $templateParams = ['invoice' => $invoice, 'order' => $order, 'store' => $this->_objectManager->get(StoreManagerInterface::class)->getStore($storeId), 'customer_name' => trim($order->getData('customer_firstname') . ' ' . $order->getData('customer_lastname'))];

            $invoiceCollection = $this->_objectManager->get(Collection::class)->addFieldToFilter('entity_id', $invoice->getId())->load();

            // Starting on sending an email
            $transport = $this->_objectManager->get(TransportBuilder::class)
                ->setTemplateIdentifier($templateId)
                ->setTemplateOptions(['area' => 'frontend', 'store' => $storeId])
                ->setTemplateVars($templateParams)
                ->setFrom($from)
                ->addTo($customerEmail, trim($order->getCustomerFirstname() . ' ' . $order->getCustomerLastname()))
                ->getTransport();
            //  dd($transport->getMessage()->getBody()->getPartContent(0));
            //  $bodyMessage = $transport->getMessage()->getBody()->getPartContent(0);
            // $aa = str_replace(array("=0D=A)","\r"), '', $bodyMessage);

            //  dd($aa);
            //   exit;

            $transport = $this->addAttachment($transport, $this->generatePdfInvoice($invoiceCollection), 'invoice' . $invoice->getIncrementId() . '.pdf');

            $transport->sendMessage();

            $this->messageManager->addSuccess(__('You sent an email to the customer email %1 to succeed.', $customerEmail));
        } catch (Exception $e) {
            $this->messageManager->addError(__('Can not send an email.'));
            $this->messageManager->addError($e->getMessage());
        }

        // $redirectUrl = $this->_url->getUrl('sales/invoice/view', ['invoice_id' => $invoiceId]);

       // $this->getResponse()->setRedirect($redirectUrl);
    }

    /**
     * Attach the pdf to email
     * This is the function for adding an attachment to the email
     *
     * @param TransportBuilder $transport
     * @param string $pdfString
     * @param string $pdfFileName
     * @return TransportBuilder
     */
    public function addAttachment($transport, $pdfString, $pdfFileName)
    {
        $attachment = $this->_objectManager->get(PartFactory::class)->create();
        $attachment->setContent($pdfString)->setType('application/pdf')->setFileName($pdfFileName)->setDisposition(Zend_Mime::DISPOSITION_ATTACHMENT)->setEncoding(Zend_Mime::ENCODING_BASE64);

        $bodyHtml = $this->_objectManager->get(PartFactory::class)->create();
        $bodyHtml->setContent($transport->getMessage()->getBody()->generateMessage())->setType('text/html');

        $bodyPart = $this->_objectManager->get(Message::class);
        $bodyPart->addPart($bodyHtml);
        $bodyPart->addPart($attachment);
        $transport->getMessage()->setBody($bodyPart);
        return $transport;
    }

    /**
     * Generate the PDF invoice
     *
     * @param \Magento\Sales\Model\Order\Invoice $invoice
     * @return string
     */
    public function generatePdfInvoice($invoice)
    {
        $pdf = $this->_objectManager->get(Invoice::class)->getPdf($invoice);
        return $pdf->render();
    }
}
