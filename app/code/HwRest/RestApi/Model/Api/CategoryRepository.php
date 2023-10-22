<?php

declare(strict_types=1);

namespace HwRest\RestApi\Model\Api;

use HwRest\RestApi\Api\CategoryInterface;
use HwRest\RestApi\Api\CategoryInterfaceFactory;
use HwRest\RestApi\Api\CategoryRepositoryInterface;
use Magento\Catalog\Api\Data\CategoryInterface as MagentoCategoryInterface;
use Magento\Catalog\Model\ResourceModel\Category\Collection;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;


class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CollectionFactory
     */
    private CollectionFactory $categoryCollectionFactory;

    /**
     * @var CategoryInterfaceFactory
     */
    private CategoryInterfaceFactory $categoryFactory;

    public function __construct(
        CollectionFactory        $categoryCollectionFactory,
        CategoryInterfaceFactory $categoryFactory
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryFactory = $categoryFactory;
    }

    /**
     * @param int $id
     * @return CategoryInterface
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function getItem(int $id): CategoryInterface
    {
        $collection = $this->getCategoryCollection()
            ->addAttributeToFilter('entity_id', ['eq' => $id]);

        /** @var MagentoCategoryInterface $category */
        $category = $collection->getFirstItem();
        if (!$category->getId()) {
            throw new NoSuchEntityException(__('Category not found'));
        }

        return $this->getResponseItemFromCategory($category);
    }

    /**
     * @return array|CategoryInterface[]
     * @throws LocalizedException
     */
    public function getList(): array
    {
        $categories = $this->getCategoryCollection();
        $collection = [];

        foreach ($categories as $category) {
            $collection[] = $this->getResponseItemFromCategory($category);
        }
        return $collection;

    }

    /**
     * @param MagentoCategoryInterface $category
     * @return CategoryInterface
     */
    private function getResponseItemFromCategory(MagentoCategoryInterface $category): CategoryInterface
    {
        $categoryData = $this->categoryFactory->create();

        $categoryData->setId((int)$category->getId())
            ->setName((string)$category->getName())
            ->setUrl($category->getUrl());

        return $categoryData;
    }


    /**
     * @throws LocalizedException
     */
    private function getCategoryCollection(): Collection
    {
        $collection = $this->categoryCollectionFactory->create();
        $collection
            ->addAttributeToSelect(
                [
                    'name',
                ],
            );

        return $collection;
    }

}
