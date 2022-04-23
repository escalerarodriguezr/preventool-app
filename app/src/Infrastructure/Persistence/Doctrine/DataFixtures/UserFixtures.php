<?php

namespace Preventool\Infrastructure\Persistence\Doctrine\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Domain\User\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture implements FixtureInterface
{
    const FAKE_UUID = '03df8a4e-4598-4033-9bbf-8cd90d7b1f99';
    
    const ROOT_NAME = 'Root';
    const ROOT_LASTNAME = 'Root';
    const ROOT_ID = 1;
    const ROOT_UUID = '03df8a4e-4598-4033-9bbf-8cd90d7b1f36';
    const ROOT_EMAIL = 'root@api.com';
    const ROOT_PASSWORD = 'peter-password';
    const ROOT_ROLE = User::ROLE_ROOT;

    const FRODO_NAME = 'Frodo';
    const FRODO_LASTNAME = 'Bolso';
    const FRODO_ID = 2;
    const FRODO_UUID = '03df8a4e-4598-4033-9bbf-8cd90d7b1f37';
    const FRODO_EMAIL = 'frodo@api.com';
    const FRODO_PASSWORD = 'frodo-password';
    const FRODO_ROLE = User::ROLE_ADMIN;

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $root = $this->createUser(
            self::ROOT_EMAIL,
            self::ROOT_PASSWORD,
            self::ROOT_ROLE,
            self::ROOT_UUID,
            self::ROOT_NAME,
            self::ROOT_LASTNAME
        );
        $manager->persist($root);

        $frodo = $this->createUser(
            self::FRODO_EMAIL,
            self::FRODO_PASSWORD,
            self::FRODO_ROLE,
            self::FRODO_UUID,
            self::FRODO_NAME,
            self::FRODO_LASTNAME
        );
        $frodo->setCreator($root);
        $manager->persist($frodo);

        $manager->flush();
    }

    private function createUser(string $email, string $password, string $role, string $uuid, string $name, string $lastName): User
    {
        $user = new User(
            $uuid,
            new Email($email),
            new UserRole($role),
            new NonEmptyString($name),
            new NonEmptyString($lastName)
        );
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $password
        );

        $user->setPassword($hashedPassword);
        $user->setIsActive(true);
        $user->setIsEmailConfirmed(true);
        return $user;
    }

}