<?php

declare(strict_types=1);

namespace HwPlugin\CustomerLogin\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Login extends AbstractDb
{
    /**
     * Dependency Initialization
     *
     * @return void
     */
    public function _construct(): void
    {
        $this->_init("hw_plugin_user", "customer_id");
    }
}
