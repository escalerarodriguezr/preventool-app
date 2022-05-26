<?php
declare(strict_types=1);

namespace Preventool\Domain\Organization\Model\Exception;

use Preventool\Domain\Shared\Value\Email;

class OrganizationAlreadyExistsException extends \DomainException
{
    public static function withEmail(Email $email): self
    {
        throw new self(\sprintf('Organization with email %s already exists', $email->getValue()));
    }

}