<?php
declare(strict_types=1);

namespace App\Controller\Organization;


use Preventool\Domain\Shared\Service\UuidValidator\UuidValidator;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GetOrganizationByUuidController
{


    public function __construct(
        private UuidValidator $uuidValidator
    )
    {
    }

    public function __invoke(string $uuid):Response
    {
        $this->uuidValidator->validate($uuid);
        dd($uuid);
        return new JsonResponse(
            null,
            Response::HTTP_OK
        );
        // TODO: Implement __invoke() method.
    }


}