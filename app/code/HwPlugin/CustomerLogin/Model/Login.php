<?php

namespace HwPlugin\CustomerLogin\Model;

use Magento\Framework\Model\AbstractModel;

class Login extends AbstractModel
{
    const ID = 'id';
    /**
     * Entity Id
     */
    const ENTITY_ID = 'entity_id';

    /**
     * Get Id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return parent::getData(self::ENTITY_ID);
    }

    /**
     * Set Id
     *
     * @param int $id
     * @return Login
     */
    public function setId($id): Login
    {
        return $this->setData(self::ENTITY_ID, $id);
    }
}
