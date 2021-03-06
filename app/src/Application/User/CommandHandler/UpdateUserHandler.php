<?php
declare(strict_types=1);

namespace Preventool\Application\User\CommandHandler;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\CanNotDeactivateItSelf;
use Preventool\Domain\User\Model\Service\UpdateUserRules\UpdateUserRules;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Domain\User\Repository\UserRepository;

class UpdateUserHandler implements CommandHandler
{

    public function __construct(
        private UserRepository $userRepository,
        private UpdateUserRules $updateUserRules,
        private CanNotDeactivateItSelf $canNotDeactivateItSelfRule
    )
    {
    }

    public function __invoke(UpdateUser $updateUser):void
    {

        $actionUser = $this->userRepository->find($updateUser->getActionUserId());
        $user = $this->userRepository->findByUuid($updateUser->getUuid());
        $this->updateUserRules->satisfiedBy($actionUser,$user);

        if( $updateUser->getIsActive() !== null ){;
            $this->canNotDeactivateItSelfRule->satisfiedBy($actionUser,$user);
            $user->setIsActive($updateUser->getIsActive());
        }

        if( !empty($updateUser->getName()) ){
            $user->setName(new NonEmptyString($updateUser->getName()));
        }

        if( !empty($updateUser->getLastName()) ){
            $user->setLastName(new NonEmptyString($updateUser->getLastName()));
        }

        if( !empty($updateUser->getEmail()) ){
            $user->setEmail(new Email($updateUser->getEmail()));
        }

        if( !empty($updateUser->getRole()) ){
            $user->setRole(new UserRole($updateUser->getRole()));
        }

        $this->userRepository->save($user);
    }

}