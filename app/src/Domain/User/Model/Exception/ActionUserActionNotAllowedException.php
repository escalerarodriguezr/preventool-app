<?php

namespace Preventool\Domain\User\Model\Exception;

class ActionUserActionNotAllowedException extends \DomainException
{
    public static function fromDomainRules(string $id): self
    {
        throw new self(\sprintf('User with UUID %s account does not have permissions', $id));
    }

}