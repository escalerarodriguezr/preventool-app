<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\Organization;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Preventool\Domain\Organization\Model\Entity\Organization;
use Preventool\Domain\Organization\Model\Exception\OrganizationAlreadyExistsException;
use Preventool\Domain\Organization\Repository\OrganizationFilter;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\Shared\Repository\View\PaginatedQueryView;
use Preventool\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineOrganizationRepository extends MysqlDoctrineBaseRepository implements OrganizationRepository
{
    protected static function entityClass(): string
    {
        return Organization::class;
    }

    public function save(Organization $organization): void
    {
        try{
            $this->saveEntity($organization);
        }catch (UniqueConstraintViolationException $exception){
            throw OrganizationAlreadyExistsException::withEmail($organization->getEmail());
        }
    }

    public function searchPaginated(QueryCondition $queryCondition, OrganizationFilter $filter, $fetchJoinCollections = false): PaginatedQueryView
    {
        $queryBuilder = $this->search($filter);
        $queryBuilder
            ->setFirstResult($queryCondition->getPageSize() * ($queryCondition->getCurrentPage()-1))
            ->setMaxResults($queryCondition->getPageSize())
            ->orderBy(sprintf('o.%s',$queryCondition->getOrderBy()), $queryCondition->getOrderDirection());

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

    private function search(OrganizationFilter $filter): QueryBuilder
    {
        $queryBuilder = $this->objectRepository->createQueryBuilder('o');

        if(!empty($filter->getFilterByEmail())){
            $queryBuilder->andWhere('o.email = :email')
                ->setParameter(':email', $filter->getFilterByEmail());
        }

        if(!empty($filter->getFilterByUuid())){
            $queryBuilder->andWhere('o.uuid = :uuid')
                ->setParameter(':uuid', $filter->getFilterByUuid());
        }

        if($filter->getFilterByIsActive() !== null) {
            $queryBuilder->andWhere
            (
                $queryBuilder->expr()->eq('o.isActive', ':active'),
            )
                ->setParameter(':active', $filter->getFilterByIsActive());
        }

        return $queryBuilder;
    }

}