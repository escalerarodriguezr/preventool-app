<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Query\SearchUserQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Shared\QueryConditionRequest;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\SearchUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SearchUserController
{
    public function __construct(
        private QueryBus $queryBus
    )
    {
    }

    public function __invoke(
        SearchUserRequest $request,
        QueryConditionRequest $queryConditionsRequest
    ):Response
    {

        $response = $this->queryBus->handle((new SearchUserQuery())
            ->setCurrentPage($queryConditionsRequest->getCurrentPage())
            ->setPageSize($queryConditionsRequest->getPageSize())
            ->setOrderBy($queryConditionsRequest->getOrderBy())
            ->setOrderDirection($queryConditionsRequest->getOrderDirection())
            ->setFilterByEmail($request->getFilterByEmail())
            ->setFilterByUuid($request->getFilterByUuid())
            ->setFilterByIsActive($request->getFilterByIsActive())
        );

        return new JsonResponse($response->toArray(),Response::HTTP_OK);
    }

}