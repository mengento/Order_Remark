<?php

namespace Mengento\OrderRemark\Controller\Adminhtml\Order;

class Add extends \Mengento\OrderRemark\Controller\Adminhtml\Order
{

    public function execute()
    {
	$order = $this->_initOrder();
      if ($order) {
        try {

        $data = $this->getRequest()->getPost('remark');
        if (empty($data['comment']) && $data['status'] == $order->getDataByKey('status')) {
                throw new \Magento\Framework\Exception\LocalizedException(__('Please enter a comment.'));
        }
        $comment = array(
                'increment_id'=>$order->getIncrementId(),
                'entity_id'=>$order->getId(),
                'created_at'=> date('Y-m-d H:i:s'),
                'user'=>$this->getUser()->getFirstname(),
                'remark'=> $data['comment'],
            );
	$remark = $this->_initRemark();
	$remark->setData($comment);
	$remark->save();
	return $this->resultPageFactory->create();
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $response = ['error' => true, 'message' => $e->getMessage()];
        } catch (\Exception $e) {
                $response = ['error' => true, 'message' => __('We cannot add order remark.')];
        }
            if (is_array($response)) {
                $resultJson = $this->resultJsonFactory->create();
                $resultJson->setData($response);
                return $resultJson;
            }
        }
        return $this->resultRedirectFactory->create()->setPath('sales/*/');
    }
}
