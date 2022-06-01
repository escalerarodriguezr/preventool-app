<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\Query\GetOrganizationByUuidQuery;

use Preventool\Domain\Shared\Bus\Query\Query;

class GetOrganizationByUuidQuery implements Query
{
    public function __construct(private string $uuid)
    {
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

}