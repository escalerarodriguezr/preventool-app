<?php

namespace Preventool\Application\User\Query\GetUserByUuidQuery;

use Preventool\Domain\Shared\Bus\Query\Query;

class GetUserByUuidQuery implements Query
{
    private string $uuid;

    public function __construct(string $uuid)
    {
        $this->uuid = $uuid;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }




}