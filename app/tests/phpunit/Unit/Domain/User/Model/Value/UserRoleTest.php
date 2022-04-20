<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\User\Model\Value;

use DomainException;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Value\UserRole;

class UserRoleTest extends TestCase
{
    public function testValueOk()
    {
        $roleRoot = new UserRole(User::ROLE_ROOT);
        $roleAdmin = new UserRole(User::ROLE_ADMIN);
        self::assertEquals(User::ROLE_ROOT, $roleRoot->getValue());
        self::assertEquals(User::ROLE_ADMIN, $roleAdmin->getValue());
    }

    public function testValueDomainException()
    {
        self::expectException(DomainException::class);
        new UserRole("ROLE_FAKE");
    }

}