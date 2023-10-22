<?php

namespace HwPlugin\CustomerLogin\Model\ResourceModel;

use Magento\Framework\App\ResourceConnection;

class AccountRepository
{
    private const TABLE_NAME = 'hw_plugin_user';

    /**
     * @var ResourceConnection $resource
     */
    private ResourceConnection $resource;

    public function __construct(ResourceConnection $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @throws \Zend_Db_Statement_Exception
     */
    public function validation(string $ip_address): array
    {
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName(self::TABLE_NAME);

        $sql = "SELECT * FROM $table WHERE ip_address = '$ip_address'";

       return $conn->query($sql)->fetchAll();
    }

    /**
     * @param int $customerId
     * @param string $ip_address
     * @return void
     */
    public function save(int $customerId, string $ip_address): void
    {
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName(self::TABLE_NAME);

        $bind = [
            'customer_id' => $customerId,
            'ip_address' => $ip_address
        ];
        $conn->insert($table, $bind);
    }

    /**
     * @param int $customerId
     * @return void
     */
    public function delete(int $customerId): void
    {
        $conn = $this->resource->getConnection();
        $table = $this->resource->getTableName(self::TABLE_NAME);

        $bind = [
            'customer_id=' . $customerId
        ];

        $conn->delete($table, $bind);
    }
}
