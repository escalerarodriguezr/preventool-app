<?php

namespace Preventool\Domain\Company\Model\Service\UpdateCompanyRules\Rules;

use Preventool\Domain\User\Model\Entity\User;

interface UpdateCompanyRule
{
    public function satisfiedBy(User $actionUser):void;

}