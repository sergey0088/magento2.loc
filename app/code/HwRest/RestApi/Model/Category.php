<?php

declare(strict_types=1);

namespace HwRest\RestApi\Model;

use HwRest\RestApi\Api\CategoryInterface;
use Magento\Framework\DataObject;

/**
 * Class Category
 */
class Category extends DataObject implements CategoryInterface
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_getData(self::CATEGORY_ID);
    }

    /**
     * @param int $id
     * @return \HwRest\RestApi\Api\CategoryInterface
     */
    public function setId(int $id): \HwRest\RestApi\Api\CategoryInterface
    {
        return $this->setData(self::CATEGORY_ID, $id);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->_getData(self::NAME);
    }

    /**
     * @param string $name
     * @return \HwRest\RestApi\Api\CategoryInterface
     */
    public function setName(string $name): \HwRest\RestApi\Api\CategoryInterface
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->_getData(self::URL);
    }

    /**
     * @param string $url
     * @return \HwRest\RestApi\Api\CategoryInterface
     */
    public function setUrl(string $url): \HwRest\RestApi\Api\CategoryInterface
    {
        return $this->setData(self::URL, $url);
    }

}
