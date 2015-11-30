<?php
namespace Mengento\OrderRemark\Model\Resource\Remark;
use \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
class Collection extends AbstractCollection
{

    protected function _construct()
    {
        $this->_init('Mengento\OrderRemark\Model\Remark', 'Mengento\OrderRemark\Model\Resource\Remark');
    }

}
