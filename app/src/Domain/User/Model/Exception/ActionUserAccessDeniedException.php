<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Exception;

class ActionUserAccessDeniedException extends \DomainException
{
    public static function fromSecurity(string $id): self
    {
        throw new self(\sprintf('User with UUID %s account is not found', $id));
    }

    public static function fromHttpActionUserService(string $id): self
    {
        throw new self(\sprintf('User with UUID %s account is not found', $id));
    }

}