<?php

declare(strict_types=1);

namespace HwPlugin\CustomerLogin\Plugin;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;
use Magento\Framework\DB\Adapter\Pdo\Mysql;
use Magento\Framework\Exception\InvalidEmailOrPasswordException;
use Magento\Customer\Model\AccountManagement;

class CustomerLogin
{
    protected ResourceConnection $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param AccountManagement $subject
     * @param $username
     * @param $password
     * @return array|null
     */
    public function beforeAuthenticate(AccountManagement $subject, $username, $password): ?array
    {
        $objectManager = ObjectManager::getInstance();
        $remote = $objectManager->get('Magento\Framework\HTTP\PhpEnvironment\RemoteAddress');

        /** @var ResourceConnection $this ->resource */
        /** @var Mysql $conn */
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName('hw_plugin_user');
        $ip_address = $remote->getRemoteAddress();

        $sql = "SELECT * FROM $table WHERE ip_address = '$ip_address'";

        if ($conn->query($sql)->fetchAll()) {
            throw new InvalidEmailOrPasswordException(__('Invalid login or password.'));
        }
        return null;
    }
}
