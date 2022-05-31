<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Repository;

use Preventool\Domain\Organization\Model\Entity\Organization;
use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\Shared\Repository\View\PaginatedQueryView;

interface OrganizationRepository
{
    public function save(Organization $organization):void;
    public function searchPaginated(QueryCondition $queryCondition, OrganizationFilter $filter, $fetchJoinCollections = false): PaginatedQueryView;
}