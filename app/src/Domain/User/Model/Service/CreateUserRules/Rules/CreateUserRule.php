<?php

namespace Preventool\Domain\User\Model\Service\CreateUserRules\Rules;

use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\User\Model\Entity\User;

interface CreateUserRule
{
    public function satisfiedBy(User $actionUser, CreateUser $command): void;

}