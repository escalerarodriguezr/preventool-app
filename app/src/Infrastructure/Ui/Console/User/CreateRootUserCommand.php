<?php

namespace Preventool\Infrastructure\Ui\Console\User;

use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Domain\User\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CreateRootUserCommand extends Command
{

    protected static $defaultName = 'app:create-root-user';

    public function __construct(
        private UserRepository $userRepository,
        private IdentifierGenerator $identifierGenerator,
        private UserPasswordHasherInterface $passwordHasher,
    )
    {
        parent::__construct();
    }


    protected function configure(): void
    {
        $this->setDescription('Create Root User');

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'Root User Creator',
            '============',
            '',
        ]);

        $helper = $this->getHelper('question');

        $question = new Question('Please enter the email ', 'root@root.com');
        $email = $helper->ask($input, $output, $question);
        if (!filter_var($email, \FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException('Invalid email');
        }

        $passwordQuestion = new Question('Please enter the password ', 'qwertyuiop');
        $password = $helper->ask($input, $output, $passwordQuestion);
        if( strlen($password)<6 ){
            throw new \DomainException('The password must have at least 6 characters');
        }

        $rootUser = new User(
            $this->identifierGenerator->uuid(),
            new Email($email),
            new UserRole(User::ROLE_ROOT),
            new NonEmptyString('RootName'),
            new NonEmptyString('RootLastName')
        );

        $hashedPassword = $this->passwordHasher->hashPassword(
            $rootUser,
            $password
        );

        $rootUser->setPassword($hashedPassword);
        $rootUser->setIsActive(true);
        $rootUser->setIsEmailConfirmed(true);
        $this->userRepository->save($rootUser);

        $output->writeln([
            'Root User Created: '. $rootUser->getUuid(),
            '============',
            '',
        ]);

        return Command::SUCCESS;
    }

}