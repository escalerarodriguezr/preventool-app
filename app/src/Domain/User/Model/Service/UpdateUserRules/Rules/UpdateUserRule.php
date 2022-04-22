<?php

namespace Preventool\Domain\User\Model\Service\UpdateUserRules\Rules;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\User\Model\Entity\User;

interface UpdateUserRule
{
    public function satisfiedBy(User $actionUser, UpdateUser $command): void;

}