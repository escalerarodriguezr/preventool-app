<?php
declare(strict_types=1);

namespace Preventool\Application\User\CommandHandler;

use Preventool\Application\User\Command\UploadUserAvatar;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Service\FileStorageManager\FileStorageManager;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\UpdateUserRules\UpdateUserRules;
use Preventool\Domain\User\Repository\UserRepository;

class UploadUserAvatarHandler implements CommandHandler
{

    public function __construct(
        private UserRepository $userRepository,
        private UpdateUserRules $updateUserRules,
        private FileStorageManager $fileStorageManager
    )
    {
    }

    public function __invoke(UploadUserAvatar $command):void
    {
        $actionUser = $this->userRepository->find($command->getActionUserId());
        $user = $this->userRepository->findByUuid($command->getUuid());

        try{
            $this->updateUserRules->satisfiedBy($actionUser,$user);
        }catch (ActionUserActionNotAllowedException $e){
            $this->fileStorageManager->deleteFile($command->getAvatarResource());
            throw $e;
        }

        $resourceToRemove = $user->getAvatarResource();
        $user->setAvatarResource($command->getAvatarResource());
        $this->userRepository->save($user);
        $this->fileStorageManager->deleteFile($resourceToRemove);
    }
}