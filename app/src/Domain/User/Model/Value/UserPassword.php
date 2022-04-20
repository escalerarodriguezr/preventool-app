<?php

namespace Preventool\Domain\User\Model\Value;

use Preventool\Domain\Shared\Value\NonEmptyString;

class UserPassword extends NonEmptyString
{
    public function __construct(string $value)
    {
        if( strlen($value) < 6 ){
            throw new \DomainException('The password must have at least 6 characters');
        }
        parent::__construct($value);
    }
}