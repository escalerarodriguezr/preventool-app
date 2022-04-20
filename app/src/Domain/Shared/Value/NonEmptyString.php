<?php
declare(strict_types=1);

namespace Preventool\Domain\Shared\Value;

use DomainException;

class NonEmptyString
{
    protected string $value;

    public function __construct(string $value)
    {

        if (trim($value) === '') {
            throw new DomainException(sprintf('"%s" is an empty string', $value));
        }
        $this->value = trim($value);
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function __toString()
    {
        return $this->getValue();
    }

}