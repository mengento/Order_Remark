<?php
namespace Mengento\OrderRemark\Model\Resource;
use \Magento\Framework\Model\ResourceModel\Db\AbstractDb;
class Remark extends AbstractDb
{
	public function _construct()
	{
	    $this->_init('order_remark', 'id');
	}
}
