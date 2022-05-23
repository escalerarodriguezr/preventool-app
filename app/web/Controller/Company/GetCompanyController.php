<?php
declare(strict_types=1);

namespace App\Controller\Company;

use Preventool\Application\Company\Query\GetCompanyQuery\GetCompanyQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetCompanyController
{

    public function __construct(private QueryBus $queryBus)
    {
    }

    public function __invoke():Response
    {
        return new JsonResponse(
            $this->queryBus->handle(new GetCompanyQuery())->toArray(),
            Response::HTTP_OK
        );
    }

}