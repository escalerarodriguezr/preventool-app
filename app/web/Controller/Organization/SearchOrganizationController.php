<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Preventool\Application\Organization\Query\SearchOrganizationQuery\SearchOrganizationQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Organization\SearchOrganizationRequest;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Shared\QueryConditionRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SearchOrganizationController
{


    public function __construct(
        private QueryBus $queryBus
    )
    {
    }

    public function __invoke(
        SearchOrganizationRequest $request,
        QueryConditionRequest $queryConditionsRequest
    ):Response
    {
        $response = $this->queryBus->handle((new SearchOrganizationQuery())
            ->setCurrentPage($queryConditionsRequest->getCurrentPage())
            ->setPageSize($queryConditionsRequest->getPageSize())
            ->setOrderBy($queryConditionsRequest->getOrderBy())
            ->setOrderDirection($queryConditionsRequest->getOrderDirection())
            ->setFilterByEmail($request->getFilterByEmail())
            ->setFilterByUuid($request->getFilterByUuid())
            ->setFilterByIsActive($request->getFilterByIsActive())

        );

        dd($response);
        return new JsonResponse(
            null,
            Response::HTTP_OK
        );

    }


}