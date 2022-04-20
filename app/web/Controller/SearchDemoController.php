<?php
declare(strict_types=1);

namespace App\Controller;

use Preventool\Application\Demo\Query\SearchDemoQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;

class SearchDemoController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke()
    {
        $query = new SearchDemoQuery();
        $query->setFilterByEmail("hola@hola.com");
        $response = $this->queryBus->handle($query);
    }


}