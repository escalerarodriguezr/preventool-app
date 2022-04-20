<?php

namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\User;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\ObjectManager;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\UserAlreadyExistsException;
use Preventool\Domain\User\Model\Exception\UserNotFoundException;
use Preventool\Domain\User\Repository\UserRepository;
use Preventool\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineUserRepository extends MysqlDoctrineBaseRepository implements UserRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function entityManager(): EntityManager | ObjectManager
    {
        return $this->getEntityManager();
    }

    public function save(User $user): void
    {
        try{
            $this->saveEntity($user);
        }catch (UniqueConstraintViolationException $exception){
            throw UserAlreadyExistsException::withEmail($user->getEmail());
        }
    }

    public function find(int $id): ?User
    {
        if (null === $user = $this->objectRepository->findOneBy(['id' => $id])) {
            throw UserNotFoundException::fromId($id);
        }

        return $user;
    }

    public function findByUuid(string $uuid): ?User
    {
        if (null === $user = $this->objectRepository->findOneBy(['uuid' => $uuid])) {
            throw UserNotFoundException::fromUuid($uuid);
        }

        return $user;
    }

    public function findByEmail(string $email): ?User
    {
        if (null === $user = $this->objectRepository->findOneBy(['email' => $email])) {
            throw UserNotFoundException::fromEmail($email);
        }

        return $user;
    }


}