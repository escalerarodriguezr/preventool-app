<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\Command;

use Preventool\Domain\Shared\Bus\Command\Command;

class UpdateOrganization implements Command
{
    public function __construct(
        private string $organizationUuid,
        private int $actionUserId,
        private string $actionUserRole,
        private ?string $name = null,
        private ?string $email = null,
        private ?string $legalDocument = null,
        private ?string $address = null,
        private ?bool $isActive = null
    )
    {
    }

    public function getOrganizationUuid(): string
    {
        return $this->organizationUuid;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

}