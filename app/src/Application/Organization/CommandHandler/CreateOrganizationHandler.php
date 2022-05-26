<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\CommandHandler;

use Preventool\Application\Organization\Command\CreateOrganization;
use Preventool\Domain\Organization\Model\Entity\Organization;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Repository\UserRepository;

class CreateOrganizationHandler implements CommandHandler
{

    public function __construct(
        private UserRepository $userRepository,
        private OrganizationRepository $organizationRepository,
        private IdentifierGenerator $identifierGenerator
    )
    {
    }

    public function __invoke(CreateOrganization $createOrganization):void
    {
        $actionUser = $this->userRepository->find($createOrganization->getActionUserId());

        $organization = new Organization(
            $this->identifierGenerator->uuid(),
            new NonEmptyString($createOrganization->getName()),
            new Email($createOrganization->getEmail()),
            $actionUser
        );
        $organization->setLegalDocument($createOrganization->getLegalDocument());
        $organization->setAddress($createOrganization->getAddress());

        $this->organizationRepository->save($organization);
    }

}