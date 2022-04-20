<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Exception;

class UserAlreadyExistsException extends \DomainException
{
    public static function withEmail(string $email): self
    {
        throw new self(\sprintf('User with email %s already exists', $email));
    }

}