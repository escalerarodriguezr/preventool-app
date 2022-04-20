<?php

namespace Preventool\Domain\Shared\Service\IdentifierGenerator;

interface IdentifierGenerator
{
    public function uuid():string;
}