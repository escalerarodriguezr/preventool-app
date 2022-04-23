<?php

namespace Preventool\Domain\User\Model\Service\UpdateUserRules\Rules;

use Preventool\Domain\User\Model\Entity\User;

interface UpdateUserRule
{
    public function satisfiedBy(User $actionUser, User $user): void;
}