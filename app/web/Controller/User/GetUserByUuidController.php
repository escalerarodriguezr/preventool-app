<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Query\GetUserByUuidQuery\GetUserByUuidQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Preventool\Infrastructure\Ui\Http\Service\UuidValidatorSymfony;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GetUserByUuidController
{

    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidatorSymfony $uuidValidator,
        private QueryBus             $queryBus
    )
    {
    }

    public function __invoke(string $uuid, Request $request): Response
    {
        $this->uuidValidator->validate($uuid);
        return new JsonResponse(
            $this->queryBus->handle(new GetUserByUuidQuery($uuid))->toArray(),
            Response::HTTP_OK);
    }

}