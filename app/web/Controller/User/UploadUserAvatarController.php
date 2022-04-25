<?php
declare(strict_types=1);

namespace App\Controller\User;

use Preventool\Application\User\Command\UploadUserAvatar;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Domain\Shared\Service\FileStorageManager\FileStorageManager;
use Preventool\Infrastructure\FileStorage\DigitalOceanStorage\DigitalOceanFileStorageManager;
use Preventool\Infrastructure\Ui\Http\Request\DTO\User\UploadUserAvatarRequest;
use Preventool\Infrastructure\Ui\Http\Service\HttpActionUserService;
use Preventool\Infrastructure\Ui\Http\Service\UuidValidatorSymfony;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UploadUserAvatarController
{
    public function __construct(
        private HttpActionUserService $httpActionUserService,
        private UuidValidatorSymfony $uuidValidator,
        private DigitalOceanFileStorageManager $digitalOceanFileStorageManager,
        private CommandBus $commandBus

    )
    {
    }

    public function __invoke(string $uuid, UploadUserAvatarRequest $uploadUserAvatarRequest)
    {
        $this->uuidValidator->validate($uuid);
        $avatarResource = $this->digitalOceanFileStorageManager->uploadFile(
            $uploadUserAvatarRequest->getAvatar(),
            'avatar',
            FileStorageManager::VISIBILITY_PUBLIC
        );

        $command = new UploadUserAvatar(
            $uuid,
            $this->httpActionUserService->getUserId(),
            $this->httpActionUserService->getSessionUser()->getRole()->getValue(),
            $avatarResource
        );

        $this->commandBus->dispatch($command);

        return new JsonResponse(['avatarResource'=>$avatarResource],Response::HTTP_OK);
    }


}