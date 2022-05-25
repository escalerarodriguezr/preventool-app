<?php
declare(strict_types=1);

namespace App\Controller\Company;

use Preventool\Application\Company\Command\UpdateCompany;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Company\UpdateCompanyRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateCompanyController
{

    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private CommandBus $commandBus
    )
    {
    }

    public function __invoke(UpdateCompanyRequest $request):Response
    {

        $this->commandBus->dispatch(new UpdateCompany(
            $this->httpActionUserService->getUserId(),
            $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
            $request->getName(),
            $request->getLegalDocument(),
            $request->getAddress())
        );

        return new JsonResponse(
            null,
            Response::HTTP_OK
        );
    }


}