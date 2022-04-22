<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\UpdateUserRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Preventool\Infrastructure\Ui\Http\Service\UuidValidatorSymfony;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UpdateUserController
{


    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidatorSymfony $uuidValidator,
        private CommandBus $commandBus
    )
    {
    }

    public function __invoke(string $uuid, UpdateUserRequest $updateUserRequest):Response
    {
        $this->uuidValidator->validate($uuid);

        $command = new UpdateUser(
            $uuid,
            $this->httpActionUserService->getUserId(),
            $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
            $updateUserRequest->getName() ?? null,
            $updateUserRequest->getLastName() ?? null,
            $updateUserRequest->getEmail() ?? null
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(null,Response::HTTP_OK);


    }


}