<?php
declare(strict_types=1);

namespace Preventool\Application\Company\Command;


use Preventool\Domain\Shared\Bus\Command\Command;

class UpdateCompany implements Command
{

    public function __construct(
        private int $actionUserId,
        private string $actionUserRole,
        private ?string $name = null,
        private ?string $legalDocument = null,
        private ?string $address = null
    )
    {
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

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

}