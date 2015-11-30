<?php
namespace Mengento\OrderRemark\Model;
use Magento\Framework\Model\AbstractModel;
class Remark extends AbstractModel
{

    protected function _construct()
    {
        $this->_init('Mengento\OrderRemark\Model\Resource\Remark');
    }
}
