<?php

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

use Preventool\Application\User\Query\SearchUserQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\User\Repository\UserFilter;

class SearchUserQueryHandler implements QueryHandler
{
    public function __invoke(SearchUserQuery $query):SearchUserQueryView
    {
        $filter = new UserFilter(
            $query->getFilterByUuid(),
            $query->getFilterByEmail()
        );

        $queryCondition = (new QueryCondition())
            ->setPageSize($query->getPageSize())
            ->setCurrentPage($query->getCurrentPage())
            ->setOrderBy($query->getOrderBy())
            ->setOrderDirection($query->getOrderDirection());
        
        $view = new SearchUserQueryView(100,10,1);
        return $view;

    }


}