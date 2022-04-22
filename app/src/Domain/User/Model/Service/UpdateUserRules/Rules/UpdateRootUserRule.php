<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Service\UpdateUserRules\Rules;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;

class UpdateRootUserRule implements UpdateUserRule
{
    public function satisfiedBy(User $actionUser, UpdateUser $command): void
    {
        if( $actionUser->getRole()->getValue() != User::ROLE_ROOT ){
           throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
        }

        if( $actionUser->getUuid() != $command->getUuid() ){
            throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
        }
    }

}