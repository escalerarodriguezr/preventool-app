<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Shared\Value;

use DomainException;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\Shared\Value\NonEmptyString;

class NonEmptyStringTest extends TestCase
{
    public function testValueOk()
    {
        $name = new NonEmptyString("name");
        self::assertEquals("name", $name->getValue());
    }

    public function testValueDomainException()
    {
        self::expectException(DomainException::class);
        new NonEmptyString("");
    }

}