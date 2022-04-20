<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\User\Model\Value;

use DomainException;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\User\Model\Value\UserPassword;

class UserPasswordTest extends TestCase
{
    public function testValueOk()
    {
        $password = new UserPassword("qwertyuiop");
        self::assertEquals("qwertyuiop", $password->getValue());
    }

    public function testValueDomainException()
    {
        self::expectException(DomainException::class);
        new UserPassword("fake");
    }

}