<?php

namespace HwPlugin\CustomerLogin\Model\ResourceModel\Login;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'customer_id';

    /**
     * Dependency Initialization
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(
            \HwPlugin\CustomerLogin\Model\Login::class,
            \HwPlugin\CustomerLogin\Model\ResourceModel\Login::class
        );
        $this->_map['fields']['customer_id'] = 'hw_plugin_user.customer_id';
    }
}
