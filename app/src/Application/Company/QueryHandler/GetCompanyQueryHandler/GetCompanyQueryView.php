<?php
declare(strict_types=1);

namespace Preventool\Application\Company\QueryHandler\GetCompanyQueryHandler;

class GetCompanyQueryView
{

    public function __construct(
        private int $id,
        private string $uuid,
        private string $name,
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

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function toArray():array
    {
        return[
            'id' => $this->id,
            'uuid' => $this->uuid,
            'name' => $this->name,
            'legalDocument' => $this->legalDocument,
            'address' => $this->address
        ];
    }


}