<?php
declare(strict_types=1);

namespace Preventool\Application\User\CommandHandler;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Repository\UserRepository;

class UpdateUserHandler implements CommandHandler
{


    public function __construct(
        private UserRepository $userRepository

    )
    {
    }

    public function __invoke(UpdateUser $updateUser):void
    {
        //Validar permisos

        $user = $this->userRepository->findByUuid($updateUser->getUuid());

        if( !empty($updateUser->getName()) ){
            $user->setName(new NonEmptyString($updateUser->getName()));
        }



        if( !empty($updateUser->getLastName()) ){
            $user->setLastName(new NonEmptyString($updateUser->getLastName()));
        }

        if( !empty($updateUser->getEmail()) ){
            $user->setEmail(new Email($updateUser->getEmail()));
        }



        $this->userRepository->save($user);

    }


}