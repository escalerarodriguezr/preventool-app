<?php

namespace Preventool\Domain\User\Model\Value;

use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;

class UserRole extends NonEmptyString
{
    const VALID_ROLES =[
        User::ROLE_ROOT,
        User::ROLE_ADMIN
    ];

    public function __construct(string $value)
    {
        if( !in_array(trim($value),self::VALID_ROLES) ){
            throw new \DomainException(sprintf('"%s" is an invalid role', $value));
        }
        parent::__construct($value);
    }

}