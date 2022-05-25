<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Service\UpdateCompanyRules;

use Preventool\Domain\Company\Model\Service\UpdateCompanyRules\Rules\UpdateCompanyOnlyByRootUserRule;
use Preventool\Domain\User\Model\Entity\User;

class UpdateCompanyRules
{
    private array $rules;


    public function __construct()
    {
        $this->rules = [
            new UpdateCompanyOnlyByRootUserRule()
        ];
    }

    public function satisfiedBy(User $actionUser):void
    {
        foreach ( $this->rules as $rule ){
            $rule->satisfiedBy($actionUser);
        }
    }

}