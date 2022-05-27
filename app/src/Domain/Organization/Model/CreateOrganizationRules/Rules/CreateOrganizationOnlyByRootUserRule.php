<?php

namespace Preventool\Domain\Organization\Model\CreateOrganizationRules\Rules;

use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;

class CreateOrganizationOnlyByRootUserRule implements CreateOrganizationRule
{
    public function satisfiedBy(User $actionUser): void
    {
        if( $actionUser->getRole()->getValue() != User::ROLE_ROOT ){
            throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
        }
    }

}