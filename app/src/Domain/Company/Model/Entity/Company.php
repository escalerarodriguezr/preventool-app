<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Entity;

use Preventool\Domain\Shared\Value\NonEmptyString;

class Company
{
    private ?int $id;
    private string $uuid;
    private string $name;
    private ?string $legalDocument;
    private ?string $address;
    private \DateTime $createdOn;
    private ?\DateTime $updatedOn;


    public function __construct(
        string $uuid,
        NonEmptyString $name,
        ?string $legalDocument=null,
        ?string $address=null
    )
    {
        $this->uuid = $uuid;
        $this->name = $name->getValue();
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

    public function getName(): NonEmptyString
    {
        return new NonEmptyString($this->name);
    }

    public function setName(NonEmptyString $name): void
    {
        $this->name = $name->getValue();
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