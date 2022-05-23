<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Persistence\Doctrine\Repository\Company;

use Preventool\Domain\Company\Model\Entity\Company;
use Preventool\Domain\Company\Model\Exception\CompanyAlreadyExistsException;
use Preventool\Domain\Company\Repository\CompanyRepository;
use Preventool\Infrastructure\Persistence\Doctrine\Repository\MysqlDoctrineBaseRepository;

class DoctrineCompanyRepository extends MysqlDoctrineBaseRepository implements CompanyRepository
{
    protected static function entityClass(): string
    {
        return Company::class;
    }

    public function save(Company $company): void
    {
        $companyAlreadyExist = ($this->objectRepository->createQueryBuilder('c'))->select('count(c.id)')
            ->getQuery()
            ->getSingleScalarResult();

        if($companyAlreadyExist){
            throw CompanyAlreadyExistsException::mustBeUnique();
        }

        $this->saveEntity($company);
    }
}