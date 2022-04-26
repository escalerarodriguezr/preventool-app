<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\Shared;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;

class QueryConditionRequest implements RequestDTO
{
    private ?int $pageSize;
    private ?int $currentPage;
    private ?string $orderBy;
    private ?string $orderDirection;


    public function __construct(Request $request)
    {
        $this->pageSize = empty($request->query->get('pageSize')) ? 10 : (int) $request->query->get('pageSize');
        $this->currentPage = empty($request->query->get('currentPage')) ? 1 : (int) $request->query->get('currentPage');
        $this->orderBy = empty($request->query->get('orderBy')) ? 'createdOn' : (string) $request->query->get('orderBy');
        $this->orderDirection = empty($request->query->get('orderDirection')) ? 'DESC' : (string) $request->query->get('orderDirection');
    }

    public function getPageSize(): ?int
    {
        return $this->pageSize;
    }


    public function setPageSize(?int $pageSize): void
    {
        $this->pageSize = $pageSize;
    }

    public function getCurrentPage(): ?int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(?int $currentPage): void
    {
        $this->currentPage = $currentPage;
    }

    public function getOrderBy(): ?string
    {
        return $this->orderBy;
    }

    public function setOrderBy(?string $orderBy): void
    {
        $this->orderBy = $orderBy;
    }

    public function getOrderDirection(): ?string
    {
        return $this->orderDirection;
    }

    public function setOrderDirection(?string $orderDirection): void
    {
        $this->orderDirection = $orderDirection;
    }


}