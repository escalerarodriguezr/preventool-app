<?php
declare(strict_types=1);

namespace Preventool\Application\User\Query;

use Preventool\Domain\Shared\Bus\Query\Query;

class SearchUserQuery implements Query
{
    private ?int $pageSize;
    private ?int $currentPage;
    private ?string $orderBy;
    private ?string $orderDirection;

    private ?string $filterByUuid;
    private ?string $filterByEmail;
    private ?bool $filterByIsActive;
    private ?string $filterByCreatedOnFrom;
    private ?string $filterByCreatedOnTo;

    public function __construct()
    {
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }

    public function setPageSize(?int $pageSize): self
    {
        $this->pageSize = $pageSize;
        return $this;
    }

    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(?int $currentPage): self
    {
        $this->currentPage = $currentPage;
        return $this;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function setOrderBy(?string $orderBy): self
    {
        $this->orderBy = $orderBy;
        return $this;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(?string $orderDirection): self
    {
        $this->orderDirection = $orderDirection;
        return $this;
    }
    public function getFilterByUuid(): ?string
    {
        return $this->filterByUuid;
    }

    public function setFilterByUuid(?string $filterByUuid): self
    {
        $this->filterByUuid = $filterByUuid;
        return $this;
    }

    public function getFilterByEmail(): ?string
    {
        return $this->filterByEmail;
    }

    public function setFilterByEmail(?string $filterByEmail): self
    {
        $this->filterByEmail = $filterByEmail;
        return $this;
    }

    public function getFilterByIsActive(): ?bool
    {
        return $this->filterByIsActive;
    }

    public function setFilterByIsActive(?bool $filterByIsActive): self
    {
        $this->filterByIsActive = $filterByIsActive;
        return $this;
    }

    public function getFilterByCreatedOnFrom(): ?string
    {
        return $this->filterByCreatedOnFrom;
    }

    public function setFilterByCreatedOnFrom(?string $filterByCreatedOnFrom): self
    {
        $this->filterByCreatedOnFrom = $filterByCreatedOnFrom;
        return $this;
    }

    public function getFilterByCreatedOnTo(): ?string
    {
        return $this->filterByCreatedOnTo;
    }

    public function setFilterByCreatedOnTo(?string $filterByCreatedOnTo): self
    {
        $this->filterByCreatedOnTo = $filterByCreatedOnTo;
        return $this;
    }

}