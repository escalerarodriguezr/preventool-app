<?php

namespace Preventool\Domain\Shared\Service\UuidValidator;

interface UuidValidator
{
    public function validate(string $uuid):void;

}