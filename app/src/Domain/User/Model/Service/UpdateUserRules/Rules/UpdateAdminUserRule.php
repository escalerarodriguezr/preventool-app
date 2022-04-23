<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Service\UpdateUserRules\Rules;

use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;

class UpdateAdminUserRule implements UpdateUserRule
{
    public function satisfiedBy(User $actionUser, User $user): void
    {
        if( $user->getRole()->getValue() == User::ROLE_ADMIN && $actionUser->getRole()->getValue() != User::ROLE_ROOT ){
            if( $actionUser->getUuid() != $user->getUuid() ){
                throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
            }
        }
    }

}