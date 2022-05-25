<?php
declare(strict_types=1);

namespace Preventool\Application\Company\CommandHandler;

use Preventool\Application\Company\Command\UpdateCompany;
use Preventool\Domain\Company\Model\Service\UpdateCompanyRules\UpdateCompanyRules;
use Preventool\Domain\Company\Repository\CompanyRepository;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Repository\UserRepository;

class UpdateCompanyHandler implements CommandHandler
{
    public function __construct(
        private CompanyRepository $companyRepository,
        private UserRepository $userRepository,
        private UpdateCompanyRules $updateCompanyRules
    )
    {
    }

    public function __invoke(UpdateCompany $updateCompany):void
    {

        $company = $this->companyRepository->findCompany();
        $actionUser = $this->userRepository->find($updateCompany->getActionUserId());
        $this->updateCompanyRules->satisfiedBy($actionUser);

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