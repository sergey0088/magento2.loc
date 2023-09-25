<?php

declare(strict_types=1);

namespace HwPlugin\CustomerLogin\Observer;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\Pdo\Mysql;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CustomerLogoutObserver implements ObserverInterface
{
    private ResourceConnection $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    public function execute(Observer $observer): void
    {
        $customerId = $observer->getEvent()->getData('customer')->getId();

        /** @var ResourceConnection $this ->resource */
        /** @var Mysql $conn */
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName('hw_plugin_user');
        $bind = [
            'customer_id=' . $customerId
        ];

        $conn->delete($table, $bind);
    }
}
