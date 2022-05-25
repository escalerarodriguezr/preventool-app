<?php

namespace Preventool\Domain\Company\Repository;

use Preventool\Domain\Company\Model\Entity\Company;

interface CompanyRepository
{
    public function save(Company $company):void;
    public function update(Company $company):void;
    public function findCompany():Company;
}