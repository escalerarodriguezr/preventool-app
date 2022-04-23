<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Service\UpdateUserRules;

use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\UpdateAdminUserRule;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\UpdateRootUserRule;

class UpdateUserRules
{
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            new UpdateRootUserRule(),
            new UpdateAdminUserRule()
        ];
    }

    public function satisfiedBy(User $actionUSer, UpdateUser $command): void
    {
        foreach ($this->rules as $rule){
            $rule->satisfiedBy($actionUSer,$command);
        }
    }

}