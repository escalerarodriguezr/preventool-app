<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Model\CreateOrganizationRules\Rules;

use Preventool\Domain\User\Model\Entity\User;

interface CreateOrganizationRule
{
    public function satisfiedBy(User $actionUser):void;

}