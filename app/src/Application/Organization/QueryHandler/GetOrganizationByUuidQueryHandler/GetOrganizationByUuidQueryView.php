<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\QueryHandler\GetOrganizationByUuidQueryHandler;

class GetOrganizationByUuidQueryView
{
    const ID = 'id';
    const UUID = 'uuid';
    const NAME = 'name';
    const EMAIL = 'email';
    const LEGAL_DOCUMENT = 'legalDocument';
    const ADDRESS = 'address';
    const IS_ACTIVE = 'isActive';
    const CREATED_ON = 'createdOn';

    public function __construct(
        private int $id,
        private string $uuid,
        private string $name,
        private string $email,
        private bool $isActive,
        private string $createdOn,
        private ?string $legalDocument = null,
        private ?string $address = null
    )
    {
    }

    public function getId(): int
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function getCreatedOn(): string
    {
        return $this->createdOn;
    }

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function toArray(): array
    {
        return [
            self::ID => $this->id,
            self::UUID => $this->uuid,
            self::EMAIL => $this->email,
            self::NAME => $this->name,
            self::LEGAL_DOCUMENT => $this->legalDocument,
            self::ADDRESS => $this->address,
            self::IS_ACTIVE => $this->isActive,
            self::CREATED_ON => $this->createdOn
        ];
    }

}