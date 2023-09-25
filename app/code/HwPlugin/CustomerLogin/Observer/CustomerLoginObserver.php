<?php

namespace HwPlugin\CustomerLogin\Observer;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\Pdo\Mysql;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Zend_Db_Adapter_Exception;

class CustomerLoginObserver implements ObserverInterface
{
    protected ResourceConnection $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @throws Zend_Db_Adapter_Exception
     */
    public function execute(Observer $observer): string
    {
        $objectManager = ObjectManager::getInstance();
        $remote = $objectManager->get('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');
        $customer = $observer->getEvent()->getData('customer');

        /** @var ResourceConnection $this ->resource */
        /** @var Mysql $conn */
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName('hw_plugin_user');
        $bind = [
            'customer_id' => $customer->getId(),
            'ip_address' => $remote->getRemoteAddress()
        ];
        $conn->insert($table, $bind);
        return $conn->lastInsertId($table);
    }
}
