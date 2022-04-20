<?php
declare(strict_types=1);
namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\Demo;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Preventool\Domain\Demo\Model\Entity\Demo;
use Preventool\Domain\Demo\Repository\DemoRepository;
use Preventool\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineDemoRepository extends MysqlDoctrineBaseRepository implements DemoRepository
{
    protected static function entityClass(): string
    {
        return Demo::class;
    }

    public function find(int $id): ?Demo
    {
        if (null === $demo = $this->objectRepository->findOneBy(['id' => $id])) {
//            throw UserNotFoundException::fromId($id);
            return null;
        }

        return $demo;
    }

    public function save(Demo $demo): void
    {
        try{
            $this->saveEntity($demo);
        }catch (UniqueConstraintViolationException){

        }
    }

    public function remove(Demo $demo): void
    {
        $this->removeEntity($demo);
    }

    public function findByEmail(string $email): ?Demo
    {
        if (null === $demo = $this->objectRepository->findOneBy(['email' => $email])) {

        }

        return $demo;
    }
}