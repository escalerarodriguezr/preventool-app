<?php

namespace PHPUnit\Tests\Unit\Domain\User\Service\UpdateUserRules\Rules;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\UpdateAdminUserRule;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;

class UpdateAdminUserRuleTest extends TestCase
{
    private MockObject|User $actionUser;
    private UpdateAdminUserRule $updateAdminUserRule;

    public function setUp():void
    {
        parent::setUp();
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->updateAdminUserRule = new UpdateAdminUserRule();
    }

    public function testAdminActionUserCanUpdateItSelf()
    {

        $role = new UserRole(User::ROLE_ADMIN);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $role = new UserRole(User::ROLE_ADMIN);
        $user->method('getRole')
            ->willReturn($role);
        $user->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $this->updateAdminUserRule->satisfiedBy($this->actionUser,$user);
        self::assertEquals(1,1);
    }

    public function testAdminActionUserCanNotUpdateAnotherAdminUser()
    {
        $role = new UserRole(User::ROLE_ADMIN);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $role = new UserRole(User::ROLE_ADMIN);
        $user->method('getRole')
            ->willReturn($role);
        $user->method('getUuid')
            ->willReturn(UserFixtures::FAKE_UUID);

        self::expectException(ActionUserActionNotAllowedException::class);
        $this->updateAdminUserRule->satisfiedBy($this->actionUser,$user);

    }

    public function testRootActionUserCanUpdateAdminUser()
    {
        $role = new UserRole(User::ROLE_ROOT);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::ROOT_UUID);

        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $role = new UserRole(User::ROLE_ADMIN);
        $user->method('getRole')
            ->willReturn($role);
        $user->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $this->updateAdminUserRule->satisfiedBy($this->actionUser,$user);
        self::assertEquals(1,1);
    }

}