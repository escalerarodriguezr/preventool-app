<?php
declare(strict_types=1);
namespace Preventool\Application\Organization\QueryHandler\SearchOrganizationQueryHandler;

class OrganizationQueryView
{
    private int $id;
    private string $uuid;
    private string $email;
    private string $name;
    private ?string $legalDocument;
    private ?string $address;
    private bool $isActive;
    private string $createdOn;
    private ?string $updatedOn;

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

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function setLegalDocument(?string $legalDocument): self
    {
        $this->legalDocument = $legalDocument;
        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;
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

    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    public function setCreatedOn(string $createdOn): self
    {
        $this->createdOn = $createdOn;
        return $this;
    }

    public function getUpdatedOn(): ?string
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(?string $updatedOn): self
    {
        $this->updatedOn = $updatedOn;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,
            'email' => $this->email,
            'name' => $this->name,
            'legalDocument' => $this->legalDocument,
            'address' => $this->address,
            'isActive' => $this->isActive,
            'createdOn' => $this->createdOn,
            'updatedOn' => $this->updatedOn
        ];
    }


}