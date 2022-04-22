<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\UpdateUserRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;

class UpdateUserController
{


    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private CommandBus $commandBus
    )
    {
    }

    public function __invoke(UpdateUserRequest $updateUserRequest)
    {

        $command = new UpdateUser(
            $this->httpActionUserService->getUserId(),
            $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
            $updateUserRequest->getName() ?? null,
            $updateUserRequest->getLastName() ?? null,
            $updateUserRequest->getEmail() ?? null
        );


        dd($command);

    }


}