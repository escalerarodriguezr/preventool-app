<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Preventool\Application\Organization\Command\UpdateOrganization;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Domain\Shared\Service\UuidValidator\UuidValidator;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Organization\UpdateOrganizationRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateOrganizationController
{


    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidator $uuidValidator,
        private CommandBus $commandBus
    )
    {
    }

    public function __invoke(string $uuid, UpdateOrganizationRequest $updateOrganizationRequest):Response
    {

        $this->uuidValidator->validate($uuid);

        $this->commandBus->dispatch(new UpdateOrganization(
                $uuid,
                $this->httpActionUserService->getUserId(),
                $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
                $updateOrganizationRequest->getName(),
                $updateOrganizationRequest->getEmail(),
                $updateOrganizationRequest->getLegalDocument(),
                $updateOrganizationRequest->getAddress(),
                $updateOrganizationRequest->getIsActive()
            )
        );


        return new JsonResponse(null,Response::HTTP_OK);
    }


}