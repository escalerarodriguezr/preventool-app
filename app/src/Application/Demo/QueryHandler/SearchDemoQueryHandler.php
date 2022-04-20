<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\QueryHandler;

use Preventool\Application\Demo\Query\SearchDemoQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;

class SearchDemoQueryHandler implements QueryHandler
{
    public function __invoke(SearchDemoQuery $searchDemoQuery)
    {
        // TODO: Implement __invoke() method.
    }


}