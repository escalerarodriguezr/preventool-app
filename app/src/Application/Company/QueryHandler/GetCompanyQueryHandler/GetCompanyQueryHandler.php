<?php

namespace Preventool\Application\Company\QueryHandler\GetCompanyQueryHandler;

use Preventool\Application\Company\Query\GetCompanyQuery\GetCompanyQuery;
use Preventool\Domain\Company\Repository\CompanyRepository;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;

class GetCompanyQueryHandler implements QueryHandler
{

    public function __construct(
        private CompanyRepository $repository
    )
    {
    }

    public function __invoke(GetCompanyQuery $query):GetCompanyQueryView
    {
        $company = $this->repository->findCompany();
        return new GetCompanyQueryView(
            $company->getId(),
            $company->getUuid(),
            $company->getName(),
            $company->getLegalDocument(),
            $company->getAddress()
        );
    }


}