<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Service\UpdateCompanyRules\Rules;

use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;

class UpdateCompanyOnlyByRootUserRule implements UpdateCompanyRule
{
    public function satisfiedBy(User $actionUser): void
    {
       if( $actionUser->getRole()->getValue() != User::ROLE_ROOT ){
           throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
       }
    }


}