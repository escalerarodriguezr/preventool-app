<?php
declare(strict_types=1);

namespace Preventool\Application\User\Event;

use Preventool\Domain\Shared\Bus\Event\Event;

class UserCreated implements Event
{

    public function __construct(
        private string $uuid,
        private string $email,
        private string $name,
        private string $lastName
    )
    {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

}