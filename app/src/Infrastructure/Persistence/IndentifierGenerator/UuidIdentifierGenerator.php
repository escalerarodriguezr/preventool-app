<?php

namespace Preventool\Infrastructure\Persistence\IndentifierGenerator;


use Preventool\Domain\Shared\Service\IdentifierGenerator\IdentifierGenerator;
use Symfony\Component\Uid\Uuid;

final class UuidIdentifierGenerator implements IdentifierGenerator
{

    public function uuid(): string
    {
        return Uuid::v4()->toRfc4122();
    }

}