<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Model\Entity;

use Preventool\Domain\User\Model\Entity\User;

class Organization
{
    private ?int $id;
    private string $uuid;
    private string $name;
    private string $email;
    private  ?string $legalDocument;
    private ?string $address;
    private bool $isActive;

    private \DateTime $createdOn;
    private \DateTime $updatedOn;

    private User $creator;
    private ?User $updater;

    public function __construct(
        string $uuid,
        string $name,
        string $email,
        User $creator,
       )
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->email = $email;
        $this->legalDocument = null;
        $this->address = null;
        $this->isActive = true;
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
        $this->creator = $creator;
        $this->updater = null;
    }

    public function markAsUpdated():void
    {
        $this->updatedOn = new \DateTime();
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function setLegalDocument(?string $legalDocument): void
    {
        $this->legalDocument = $legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): void
    {
        $this->isActive = $isActive;
    }

    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }

    public function getUpdatedOn(): \DateTime
    {
        return $this->updatedOn;
    }

    public function getCreator(): User
    {
        return $this->creator;
    }

    public function getUpdater(): ?User
    {
        return $this->updater;
    }

    public function setUpdater(?User $updater): void
    {
        $this->updater = $updater;
    }

}