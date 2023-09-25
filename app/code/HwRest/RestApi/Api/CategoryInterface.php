<?php

declare(strict_types=1);

namespace HwRest\RestApi\Api;

interface CategoryInterface
{
    const CATEGORY_ID = 'category_id';
    const NAME = 'name';
    const URL = 'url';

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @param int $id
     * @return CategoryInterface
     */
    public function setId(int $id): CategoryInterface;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return CategoryInterface
     */
    public function setName(string $name): CategoryInterface;

    /**
     * @return string
     */
    public function getUrl(): string;

    /**
     * @param string $url
     * @return CategoryInterface
     */
    public function setUrl(string $url): CategoryInterface;
}
