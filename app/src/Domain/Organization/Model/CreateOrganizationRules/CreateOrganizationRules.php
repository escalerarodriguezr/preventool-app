<?php

namespace Preventool\Domain\Organization\Model\CreateOrganizationRules;

use Preventool\Domain\Organization\Model\CreateOrganizationRules\Rules\CreateOrganizationOnlyByRootUserRule;
use Preventool\Domain\User\Model\Entity\User;

class CreateOrganizationRules
{
    private array $rules;

    public function __construct()
    {
        $this->rules = [
            new CreateOrganizationOnlyByRootUserRule()
        ];
    }

    public function satisfiedBy(User $actionUser):void
    {
        foreach ( $this->rules as $rule ){
            $rule->satisfiedBy($actionUser);
        }
    }

}