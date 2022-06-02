<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Preventool\Domain\Shared\Service\UuidValidator\UuidValidator;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Organization\UpdateOrganizationRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationController
{


    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidator $uuidValidator
    )
    {
    }

    public function __invoke(string $uuid, UpdateOrganizationRequest $updateOrganizationRequest):Response
    {
        $this->uuidValidator->validate($uuid);
        dd($updateOrganizationRequest);
        return new JsonResponse(null,Response::HTTP_OK);
    }


}