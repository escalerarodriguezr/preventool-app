<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\Organization;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Preventool\Domain\Organization\Model\Entity\Organization;
use Preventool\Domain\Organization\Model\Exception\OrganizationAlreadyExistsException;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
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


}