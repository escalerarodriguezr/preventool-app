<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\QueryHandler\SearchOrganizationQueryHandler;

use Preventool\Application\Organization\Query\SearchOrganizationQuery\SearchOrganizationQuery;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;

class SearchOrganizationQueryHandler implements QueryHandler
{
    public function __construct()
    {
    }

    public function __invoke(SearchOrganizationQuery $query):void
    {
        dd("desde el handler", $query);
        // TODO: Implement __invoke() method.
    }


}