<?php
declare(strict_types=1);
/**
 * @author Jakub Cegiełka <kuba.ceg@gmail.com>
 */

namespace ShopBundle\ReadModel;


class PaginatedProducts
{
    /** @var array */
    private $products;

    /** @var int */
    private $page;

    /** @var int */
    private $limit;

    /** @var int */
    private $lastPage;

    public function __construct(array $products, int $page, int $limit, int $lastPage)
    {
        $this->products = $products;
        $this->page = $page;
        $this->limit = $limit;
        $this->lastPage = $lastPage;
    }

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getLastPage(): int
    {
        return $this->lastPage;
    }
}