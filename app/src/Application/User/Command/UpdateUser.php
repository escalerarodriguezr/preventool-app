<?php
declare(strict_types=1);

namespace Preventool\Application\User\Command;

use Preventool\Domain\Shared\Bus\Command\Command;

class UpdateUser implements Command
{
    private string $uuid;
    private int $actionUserId;
    private string $actionUserRole;
    private ?string $name;
    private ?string $lastName;
    private ?string $email;

    public function __construct(string $uuid, int $actionUserId, string $actionUserRole, ?string $name, ?string $lastName, ?string $email)
    {
        $this->uuid = $uuid;
        $this->actionUserId = $actionUserId;
        $this->actionUserRole = $actionUserRole;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getActionUserId(): int
    {
        return $this->actionUserId;
    }

    public function getActionUserRole(): string
    {
        return $this->actionUserRole;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }


}