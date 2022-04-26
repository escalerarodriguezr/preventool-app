<?php
declare(strict_types=1);

namespace Preventool\Domain\Shared\Repository\QueryCondition;

class QueryCondition
{
    private int $pageSize;
    private int $currentPage;
    private string $orderBy;
    private string $orderDirection;


    public function __construct()
    {
        $this->pageSize = 10;
        $this->currentPage = 1;
        $this->orderBy = 'createdAt';
        $this->orderDirection = 'DESC';
    }

    public function getPageSize(): int
    {
        return $this->pageSize;
    }


    public function setPageSize(int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): self
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function getOrderBy(): string
    {
        return $this->orderBy;
    }

    public function setOrderBy(string $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function getOrderDirection(): string
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(string $orderDirection): self
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }

}