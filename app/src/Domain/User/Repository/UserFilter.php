<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Repository;

class UserFilter
{
    public function __construct(
        private ?string $filterByUuid = null,
        private ?string  $filterByEmail = null
    )
    {
    }

    public function getFilterByUuid(): ?string
    {
        return $this->filterByUuid;
    }

    public function getFilterByEmail(): ?string
    {
        return $this->filterByEmail;
    }

}