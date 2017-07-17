<?php
declare(strict_types=1);

namespace ShopBundle\Entity;

use ShopBundle\Exception\Category\InvalidCategoryName;

/**
 * Category
 */
class Category
{
    /** @var int */
    private $id;

    /** @var string */
    private $name;


    public function __construct(string $name)
    {
        if(empty($name)) {
            throw new InvalidCategoryName();
        }

        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}

