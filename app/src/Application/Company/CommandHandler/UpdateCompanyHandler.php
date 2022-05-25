<?php
declare(strict_types=1);

namespace Preventool\Application\Company\CommandHandler;

use Preventool\Application\Company\Command\UpdateCompany;
use Preventool\Domain\Company\Repository\CompanyRepository;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Value\NonEmptyString;

class UpdateCompanyHandler implements CommandHandler
{
    public function __construct(
        private CompanyRepository $companyRepository
    )
    {
    }

    public function __invoke(UpdateCompany $updateCompany):void
    {

        $company = $this->companyRepository->findCompany();

        if( !empty($updateCompany->getName()) ){
            $company->setName(new NonEmptyString($updateCompany->getName()));
        }

        if( $updateCompany->getLegalDocument() !== null ){
            $company->setLegalDocument($updateCompany->getLegalDocument());
        }

        if( $updateCompany->getAddress() ){
            $company->setAddress($updateCompany->getAddress());
        }

        $this->companyRepository->update($company);
    }

}