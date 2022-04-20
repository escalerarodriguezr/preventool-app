<?php

namespace Preventool\Domain\User\Model\Service\CreateUserRules\Rules;

use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;

class CreateRootUserRule implements CreateUserRule
{
    public function satisfiedBy(User $actionUser, CreateUser $command): void
    {
        if( $command->getRole() == User::ROLE_ROOT ){
            throw ActionUserActionNotAllowedException::fromDomainRules($actionUser->getUuid());
        }
    }
}