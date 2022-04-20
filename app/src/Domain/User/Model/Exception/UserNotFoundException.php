<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Exception;

class UserNotFoundException extends \DomainException
{
    public static function fromId(string $id): self
    {
        throw new self(\sprintf('User with ID %s not found', $id));
    }

    public static function fromUuid(string $uuid): self
    {
        throw new self(\sprintf('User with UUID %s not found', $uuid));
    }

    public static function fromEmail(string $email): self
    {
        throw new self(\sprintf('User with email %s not found', $email));
    }



}