<?php

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

use Preventool\Application\User\Query\SearchUserQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;

class SearchUserQueryHandler implements QueryHandler
{
    public function __invoke(SearchUserQuery $query):bool
    {
        return true;
        // TODO: Implement __invoke() method.
    }


}