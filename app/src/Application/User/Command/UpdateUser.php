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
    private ?string $role;
    private ?bool $isActive;

    public function __construct(
        string $uuid,
        int $actionUserId,
        string $actionUserRole,
        ?string $name,
        ?string $lastName,
        ?string $email,
        ?string $role,
        ?bool $isActive
    )
    {
        $this->uuid = $uuid;
        $this->actionUserId = $actionUserId;
        $this->actionUserRole = $actionUserRole;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->role = $role;
        $this->isActive = $isActive;
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

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

}