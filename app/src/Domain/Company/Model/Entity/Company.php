<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Entity;

class Company
{
    private ?int $id;
    private string $uuid;
    private string $name;
    private ?string $legalDocument;
    private ?string $address;
    private \DateTime $createdOn;
    private ?\DateTime $updatedOn;

    /**
     * @param string $uuid
     * @param string $name
     * @param string|null $legalDocument
     * @param string|null $address
     */
    public function __construct(string $uuid, string $name, ?string $legalDocument=null, ?string $address=null)
    {
        $this->uuid = $uuid;
        $this->name = $name;
        $this->legalDocument = $legalDocument;
        $this->address = $address;
        $this->createdOn = new \DateTime();
        $this->markAsUpdated();
    }

    private function markAsUpdated():void
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

    public function getCreatedOn(): \DateTime
    {
        return $this->createdOn;
    }


    public function setCreatedOn(\DateTime $createdOn): void
    {
        $this->createdOn = $createdOn;
    }

    public function getUpdatedOn(): ?\DateTime
    {
        return $this->updatedOn;
    }

    public function setUpdatedOn(?\DateTime $updatedOn): void
    {
        $this->updatedOn = $updatedOn;
    }

}