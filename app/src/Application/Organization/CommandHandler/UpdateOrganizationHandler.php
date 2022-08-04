<?php

namespace Preventool\Application\Organization\CommandHandler;

use Preventool\Application\Organization\Command\UpdateOrganization;
use Preventool\Domain\Organization\Model\CreateOrganizationRules\CreateOrganizationRules;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Repository\UserRepository;
use function PHPUnit\Framework\isNull;

class UpdateOrganizationHandler implements CommandHandler
{


    public function __construct(
        private UserRepository $userRepository,
        private OrganizationRepository $organizationRepository,
        private CreateOrganizationRules $createOrganizationRules
    )
    {
    }

    public function __invoke(UpdateOrganization $updateOrganization):void
    {

        $actionUser = $this->userRepository->find($updateOrganization->getActionUserId());
        $organization = $this->organizationRepository->findByUuid($updateOrganization->getOrganizationUuid());

        $this->createOrganizationRules->satisfiedBy($actionUser);

        if( !empty($updateOrganization->getName()) ){
            $organization->setName(new NonEmptyString($updateOrganization->getName()));
        }

        if (!empty($updateOrganization->getEmail())){
            $organization->setEmail(new Email($updateOrganization->getEmail()));
        }

        if(!empty($updateOrganization->getAddress())){
            $organization->setAddress(new NonEmptyString($updateOrganization->getAddress()));
        }

        if(!empty($updateOrganization->getLegalDocument())){
            $organization->setLegalDocument(new NonEmptyString($updateOrganization->getLegalDocument()));
        }

        if( $updateOrganization->getIsActive() != null ){
            $organization->setIsActive($updateOrganization->getIsActive());
        }

        $organization->setUpdater($actionUser);

        $this->organizationRepository->save($organization);

    }

}