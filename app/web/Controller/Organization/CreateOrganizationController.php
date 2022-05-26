<?php
declare(strict_types=1);

namespace App\Controller\Organization;

use Preventool\Application\Organization\Command\CreateOrganization;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Organization\CreateOrganizationRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateOrganizationController
{


    public function __construct(
        private CommandBus $commandBus,
        private HttpActionUserService $httpActionUserService
    )
    {
    }

    public function __invoke(CreateOrganizationRequest $request):Response
    {

        $this->commandBus->dispatch(new CreateOrganization(
            $this->httpActionUserService->getUserId(),
            $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
            $request->getName(),
            $request->getEmail(),
            $request->getLegalDocument(),
            $request->getAddress()
        ));


        return new JsonResponse(
            null,
            Response::HTTP_CREATED
        );
        // TODO: Implement __invoke() method.
    }


}