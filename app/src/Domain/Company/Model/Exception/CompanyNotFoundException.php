<?php
declare(strict_types=1);

namespace Preventool\Domain\Company\Model\Exception;

class CompanyNotFoundException extends \DomainException
{
    public static function formFindCompany(): self
    {
        throw new self('Company not found');
    }

}