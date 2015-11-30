<?php

namespace Mengento\OrderRemark\Block\Adminhtml\Order\View;

class Remark extends \Magento\Backend\Block\Template
{
  /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;
    /**
     * Sales data
     *
     * @var \Magento\Sales\Helper\Data
     */
    protected $_salesData = null;
    /**
     * @var \Magento\Sales\Helper\Admin
     */

    private $adminHelper;
    protected $remarkFactory;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Sales\Helper\Data $salesData
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Helper\Admin $adminHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Sales\Helper\Data $salesData,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Helper\Admin $adminHelper,
        \Mengento\OrderRemark\Model\Resource\Remark\CollectionFactory $remarkFactory,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        $this->_salesData = $salesData;
        parent::__construct($context, $data);
        $this->adminHelper = $adminHelper;
        $this->remarkFactory = $remarkFactory;
    }


    protected function _prepareLayout()
    {
        $onclick = "submitAndReloadArea($('order_remark_block').parentNode, '" . $this->getSubmitUrl() . "')";
        $button = $this->getLayout()->createBlock(
            'Magento\Backend\Block\Widget\Button'
        )->setData(
            ['label' => __('Submit Remark'), 'class' => 'action-save action-secondary', 'onclick' => $onclick]
        );
        $this->setChild('submit_button', $button);
        return parent::_prepareLayout();
    }

    public function getOrder()
    {
        return $this->_coreRegistry->registry('sales_order');
    }

    public function getRemarkCollection()
    {
        $collection = $this->remarkFactory->create();
        $collection->addFieldToFilter('entity_id', $this->getOrder()->getId());
        return $collection;
    }

   public function getSubmitUrl()
    {
        return $this->getUrl('orderremark/*/add', ['order_id' => $this->getOrder()->getId()]);
    }

    public function escapeHtml($data, $allowedTags = null)
    {
        return $this->adminHelper->escapeHtmlWithLinks($data, $allowedTags);
    }
}
