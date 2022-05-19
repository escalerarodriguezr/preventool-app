<?php

namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\User;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\Shared\Repository\View\PaginatedQueryView;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\UserAlreadyExistsException;
use Preventool\Domain\User\Model\Exception\UserNotFoundException;
use Preventool\Domain\User\Repository\UserFilter;
use Preventool\Domain\User\Repository\UserRepository;
use Preventool\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineUserRepository extends MysqlDoctrineBaseRepository implements UserRepository
{
    protected static function entityClass(): string
    {
        return User::class;
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

    public function searchPaginated(
        QueryCondition $queryCondition,
        UserFilter $filter,
        $fetchJoinCollections = false

    ):PaginatedQueryView
    {
        $queryBuilder = $this->search($filter);
        $queryBuilder
            ->setFirstResult($queryCondition->getPageSize() * ($queryCondition->getCurrentPage()-1))
            ->setMaxResults($queryCondition->getPageSize())
            ->orderBy(sprintf('u.%s',$queryCondition->getOrderBy()), $queryCondition->getOrderDirection());

        $paginator = new Paginator($queryBuilder->getQuery(), $fetchJoinCollections);
        $total = $paginator->count();
        $pages = (int) ceil($total/$queryCondition->getPageSize());

        return new PaginatedQueryView(
            $total,
            $pages,
            $queryCondition->getCurrentPage(),
            $paginator->getIterator()
        );
    }

    private function search(UserFilter $filter): QueryBuilder
    {
        $queryBuilder = $this->objectRepository->createQueryBuilder('u');

        if(!empty($filter->getFilterByEmail())){
            $queryBuilder->andWhere('u.email = :email')
                ->setParameter(':email', $filter->getFilterByEmail());
        }

        if(!empty($filter->getFilterByUuid())){
            $queryBuilder->andWhere('u.uuid = :uuid')
                ->setParameter(':uuid', $filter->getFilterByUuid());
        }

        if($filter->getFilterByIsActive() !== null) {
            $queryBuilder->andWhere
            (
                $queryBuilder->expr()->eq('u.isActive', ':active'),
            )
                ->setParameter(':active', $filter->getFilterByIsActive());
        }

        if( !empty($filter->getFilterByCreatedOnFrom()) ){
            $queryBuilder->andWhere
            (
                $queryBuilder->expr()->gte('u.createdOn', ':createdOnFrom')
            )
                ->setParameter(':createdOnFrom', $filter->getFilterByCreatedOnFrom());
        }
        return $queryBuilder;
    }
}