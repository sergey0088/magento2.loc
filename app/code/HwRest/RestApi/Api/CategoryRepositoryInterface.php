<?php

declare(strict_types=1);

namespace HwRest\RestApi\Api;


interface CategoryRepositoryInterface
{
    /**
     * @param int $id
     * @return CategoryInterface
     */
    public function getItem(int $id): CategoryInterface;

    /**
     * @return CategoryInterface[]
     */
    public function getList(): array;
}
