<?php
declare(strict_types=1);

namespace Preventool\Application\User\CommandHandler;

use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Service\CreateUserRules\CreateUserRules;
use Preventool\Domain\User\Model\Value\UserPassword;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Domain\User\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class CreateUserHandler implements CommandHandler
{

    public function __construct(
        private UserRepository $userRepository,
        private UserPasswordHasherInterface $passwordHasher,
        private IdentifierGenerator $identifierGenerator,
        private CreateUserRules $createUserRules
    )
    {
    }

    public function __invoke(CreateUser $createUser)
    {

        $actionUser = $this->userRepository->find($createUser->getActionUserId());
        $this->createUserRules->satisfiedBy($actionUser,$createUser);

        $user = new User(
            $this->identifierGenerator->uuid(),
            new Email($createUser->getEmail()),
            new UserRole($createUser->getRole()),
            new NonEmptyString($createUser->getName()),
            new NonEmptyString($createUser->getLastName())
        );

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            (new UserPassword($createUser->getPassword()))->getValue()
        );

        $user->setPassword($hashedPassword);
        $user->setCreator($actionUser);

        if( $_ENV['REGISTER_EMAIL_REQUIRED'] == 'false' ){
            $user->setIsActive(true);
            $user->setIsEmailConfirmed(true);
        }

        $this->userRepository->save($user);
    }

}