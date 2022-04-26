<?php
declare(strict_types=1);

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

class UserQueryView
{
    private int $id;
    private string $uuid;
    private string $email;
    private string $role;
    private string $name;
    private string $lastName;
    private bool $isEmailConfirmed;
    private bool $isActive;
    private ?string $creatorUuid;
    private string $createdOn;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): self
    {
        $this->role = $role;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;
        return $this;
    }

    public function isEmailConfirmed(): bool
    {
        return $this->isEmailConfirmed;
    }

    public function setIsEmailConfirmed(bool $isEmailConfirmed): self
    {
        $this->isEmailConfirmed = $isEmailConfirmed;
        return $this;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;
        return $this;
    }

    public function getCreatorUuid(): ?string
    {
        return $this->creatorUuid;
    }

    public function setCreatorUuid(?string $creatorUuid): self
    {
        $this->creatorUuid = $creatorUuid;
        return $this;
    }

    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    public function setCreatedOn(string $createdOn): self
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'name' => $this->name,
            'lastName' => $this->lastName,
            'role' => $this->role,
            'isActive' => $this->isActive,
            'isEmailConfirmed' => $this->isEmailConfirmed,
            'creatorUuid' => $this->creatorUuid,
            'createdOn' => $this->createdOn
        ];
    }


}