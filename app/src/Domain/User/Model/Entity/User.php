<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Model\Entity;

use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Value\UserRole;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    const ROLE_ROOT = 'ROLE_ROOT';
    const ROLE_ADMIN = 'ROLE_ADMIN';

    const ROLE_MAP = [
        User::ROLE_ADMIN => 'Admin',
        User::ROLE_ROOT => 'Root',
    ];

    private ?int $id;
    private string $uuid;
    private string $email;
    private ?string $password;
    private string $role;
    private string $name;
    private string $lastName;

    private string $activationCode;
    private bool $isEmailConfirmed;
    private bool $isActive;

    private ?User $creator;
    private ?User $updater;
    private \DateTime $createdOn;
    private \DateTime $updatedOn;
    private ?\DateTime $deletedOn;


    public function __construct(
        string $uuid,
        Email $email,
        UserRole $role,
        NonEmptyString $name,
        NonEmptyString $lastName
    )
    {
        $this->uuid = $uuid;
        $this->email = $email->getValue();
        $this->role = $role->getValue();
        $this->name = $name->getValue();
        $this->lastName = $lastName->getValue();
        $this->activationCode = \sha1(\uniqid());
        $this->isEmailConfirmed = false;
        $this->isActive = false;
        $this->createdOn = new \DateTime();
        $this->deletedOn = null;
        $this->markAsUpdated();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getEmail(): Email
    {
        return new Email($this->email);
    }

    public function setEmail(Email $email): void
    {
        $this->email = $email->getValue();
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    public function getRole(): UserRole
    {
        return new UserRole($this->role);
    }

    public function setRole(UserRole $role): void
    {
        $this->role = $role->getValue();
    }

    public function getName(): NonEmptyString
    {
        return new NonEmptyString($this->name);
    }

    public function setName(NonEmptyString $name): void
    {
        $this->name = $name->getValue();
    }

    public function getLastName(): NonEmptyString
    {
        return new NonEmptyString($this->lastName);
    }

    public function setLastName(NonEmptyString $lastName): void
    {
        $this->lastName = $lastName->getValue();
    }

    public function getActivationCode(): string
    {
        return $this->activationCode;
    }

    public function setActivationCode(string $activationCode): void
    {
        $this->activationCode = $activationCode;
    }

    public function isEmailConfirmed(): bool
    {
        return $this->isEmailConfirmed;
    }

    public function setIsEmailConfirmed(bool $isEmailConfirmed): void
    {
        $this->isEmailConfirmed = $isEmailConfirmed;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getCreator(): ?User
    {
        return $this->creator;
    }

    public function setCreator(?User $creator): void
    {
        $this->creator = $creator;
    }

    public function getUpdater(): ?User
    {
        return $this->updater;
    }

    public function setUpdater(?User $updater): void
    {
        $this->updater = $updater;
    }


    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    public function setCreatedOn(\DateTime $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    public function getUpdatedOn(): \DateTime
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(\DateTime $updatedOn): void
    {
        $this->updatedOn = $updatedOn;
    }

    public function getDeletedOn(): ?\DateTime
    {
        return $this->deletedOn;
    }

    public function setDeletedOn(?\DateTime $deletedOn): void
    {
        $this->deletedOn = $deletedOn;
    }


    public function markAsUpdated(): void
    {
        $this->updatedOn = new \DateTime();
    }

    public function markAsDeleted(): void
    {
        $this->deletedOn = new \DateTime();
    }

    public function getRoles(): array
    {
        $roles[]= $this->role;;
        return array_unique($roles);

    }

    public function getSalt()
    {

    }

    public function eraseCredentials()
    {

    }

    public function getUsername(): string
    {
        return $this->email;
    }

}