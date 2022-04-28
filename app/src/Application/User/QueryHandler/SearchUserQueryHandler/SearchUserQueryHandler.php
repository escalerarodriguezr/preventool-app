<?php

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

use Preventool\Application\User\Query\SearchUserQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\User\Repository\UserFilter;
use Preventool\Domain\User\Repository\UserRepository;

class SearchUserQueryHandler implements QueryHandler
{


    public function __construct(
        private UserRepository $userRepository
    )
    {
    }

    public function __invoke(SearchUserQuery $query):SearchUserQueryView
    {
        $filter = new UserFilter(
            $query->getFilterByUuid(),
            $query->getFilterByEmail(),
            $query->getFilterByIsActive()
        );

        $queryCondition = (new QueryCondition())
            ->setPageSize($query->getPageSize())
            ->setCurrentPage($query->getCurrentPage())
            ->setOrderBy($query->getOrderBy())
            ->setOrderDirection($query->getOrderDirection());

        $paginatedQueryView = $this->userRepository->searchPaginated($queryCondition,$filter);

        return new SearchUserQueryView(
            $paginatedQueryView->getTotal(),
            $paginatedQueryView->getPages(),
            $paginatedQueryView->getCurrentPage(),
            $paginatedQueryView->getItems()
        );
    }

}