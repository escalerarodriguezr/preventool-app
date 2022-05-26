<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Repository;

use Preventool\Domain\Organization\Model\Entity\Organization;

interface OrganizationRepository
{
    public function save(Organization $organization):void;
}