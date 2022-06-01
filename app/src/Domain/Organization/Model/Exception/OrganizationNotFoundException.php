<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Model\Exception;

class OrganizationNotFoundException extends \DomainException
{
    public static function fromUuid(string $uuid):self
    {
        throw new self(\sprintf('Organization with uuid: %s not found', $uuid));
    }

}