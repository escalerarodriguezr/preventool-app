<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\QueryHandler\GetOrganizationByUuidQueryHandler;

use DateTimeInterface;
use Preventool\Application\Organization\Query\GetOrganizationByUuidQuery\GetOrganizationByUuidQuery;
use Preventool\Domain\Organization\Repository\OrganizationRepository;
use Preventool\Domain\Shared\Bus\Query\QueryHandler;

class GetOrganizationByUuidQueryHandler implements QueryHandler
{

    public function __construct(
        private OrganizationRepository $organizationRepository
    )
    {
    }

    public function __invoke(GetOrganizationByUuidQuery $query):GetOrganizationByUuidQueryView
    {
        $organization = $this->organizationRepository->findByUuid($query->getUuid());
        return new GetOrganizationByUuidQueryView(
            $organization->getId(),
            $organization->getUuid(),
            $organization->getName()->getValue(),
            $organization->getEmail()->getValue(),
            $organization->isActive(),
            $organization->getCreatedOn()->format(DateTimeInterface::RFC3339),
            $organization->getLegalDocument(),
            $organization->getAddress()
        );
    }
}