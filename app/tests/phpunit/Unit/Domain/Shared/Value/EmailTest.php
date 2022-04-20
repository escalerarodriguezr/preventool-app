<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Shared\Value;

use DomainException;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\Shared\Value\Email;

class EmailTest extends TestCase
{
    public function testValueOk()
    {
        $email = new Email("email@email.com");
        self::assertEquals("email@email.com", $email->getValue());
    }

    public function testValueDomainException()
    {
        self::expectException(DomainException::class);
        new Email("email");
    }

}