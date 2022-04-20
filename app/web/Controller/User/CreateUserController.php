<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\CreateUserRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CreateUserController
{

    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private CommandBus $commandBus
    )
    {
    }

    public function __invoke(CreateUserRequest $request): Response
    {

        $this->commandBus->dispatch(
            new CreateUser(
                $this->httpActionUserService->getUserId(),
                $request->getEmail(),
                $request->getPassword(),
                $request->getRole(),
                $request->getName(),
                $request->getLastName()
            )
        );
        return new JsonResponse(null,Response::HTTP_CREATED);
    }


}