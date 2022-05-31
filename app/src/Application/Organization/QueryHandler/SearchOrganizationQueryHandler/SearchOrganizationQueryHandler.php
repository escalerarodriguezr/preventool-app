<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\QueryHandler\SearchOrganizationQueryHandler;

use Preventool\Application\Organization\Query\SearchOrganizationQuery\SearchOrganizationQuery;
use Preventool\Domain\Organization\Repository\OrganizationFilter;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;

class SearchOrganizationQueryHandler implements QueryHandler
{
    public function __construct(
        private OrganizationRepository $organizationRepository
    )
    {
    }

    public function __invoke(SearchOrganizationQuery $query): SearchOrganizationQueryView
    {
        $filter = new OrganizationFilter(
            $query->getFilterByUuid(),
            $query->getFilterByEmail()
        );

        $queryCondition = (new QueryCondition())
            ->setPageSize($query->getPageSize())
            ->setCurrentPage($query->getCurrentPage())
            ->setOrderBy($query->getOrderBy())
            ->setOrderDirection($query->getOrderDirection());

        $paginatedQueryView = $this->organizationRepository->searchPaginated($queryCondition,$filter);

        return new SearchOrganizationQueryView(
            $paginatedQueryView->getTotal(),
            $paginatedQueryView->getPages(),
            $paginatedQueryView->getCurrentPage(),
            $paginatedQueryView->getItems()
        );
    }
}