<?php

namespace Preventool\Domain\User\Model\Service\CreateUserRules;

use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Service\CreateUserRules\Rules\CreateRootUserRule;
use Preventool\Domain\User\Model\Service\CreateUserRules\Rules\CreateAdminUserActionUserRoleRule;

class CreateUserRules
{
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            new CreateRootUserRule(),
            new CreateAdminUserActionUserRoleRule()
        ];
    }

    public function satisfiedBy(User $actionUSer, CreateUser $command): void
    {
        foreach ($this->rules as $rule){
            $rule->satisfiedBy($actionUSer,$command);
        }
    }


}