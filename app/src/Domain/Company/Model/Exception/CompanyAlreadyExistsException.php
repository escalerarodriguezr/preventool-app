<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Exception;

class CompanyAlreadyExistsException extends \DomainException
{
    public static function mustBeUnique(): self
    {
        throw new self('Company already exists');
    }
}