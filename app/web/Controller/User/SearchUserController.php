<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Infrastructure\Ui\Http\Request\DTO\Shared\QueryConditionRequest;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\SearchUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SearchUserController
{
    public function __construct()
    {
    }

    public function __invoke(
        SearchUserRequest $request,
        QueryConditionRequest $queryConditionsRequest
    ):Response
    {

        return new JsonResponse(null,Response::HTTP_OK);

    }


}