<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Preventool\Application\Organization\Query\GetOrganizationByUuidQuery\GetOrganizationByUuidQuery;
use Preventool\Domain\Shared\Bus\Query\QueryBus;
use Preventool\Domain\Shared\Service\UuidValidator\UuidValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetOrganizationByUuidController
{

    public function __construct(
        private UuidValidator $uuidValidator,
        private QueryBus $queryBus
    )
    {
    }

    public function __invoke(string $uuid):Response
    {
        $this->uuidValidator->validate($uuid);
        return new JsonResponse(
            $this->queryBus->handle(new GetOrganizationByUuidQuery($uuid))->toArray(),
            Response::HTTP_OK
        );
    }

}