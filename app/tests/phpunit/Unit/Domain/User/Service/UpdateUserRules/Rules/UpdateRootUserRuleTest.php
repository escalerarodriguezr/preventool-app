<?php

namespace PHPUnit\Tests\Unit\Domain\User\Service\UpdateUserRules\Rules;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Preventool\Application\User\Command\UpdateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\UpdateRootUserRule;
use Preventool\Domain\User\Model\Value\UserRole;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;

class UpdateRootUserRuleTest extends TestCase
{
    private MockObject|User $actionUser;
    private UpdateRootUserRule $updateRootUserRule;

    protected function setUp():void
    {
        parent::setUp();
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->updateRootUserRule = new UpdateRootUserRule();
    }

    public function testRuleActionUserActionSuccess()
    {
        $role = new UserRole(User::ROLE_ROOT);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::ROOT_UUID);

        $command = new UpdateUser(
            UserFixtures::ROOT_UUID,
            UserFixtures::ROOT_ID,
            UserFixtures::ROOT_ROLE,
            'name',
            'lastName',
            'email'
        );

        $this->updateRootUserRule->satisfiedBy($this->actionUser,$command);
        self::assertEquals(1,1);
    }

    public function testRuleActionUserActionNotAllowedExceptionByRole()
    {
        $role = new UserRole(User::ROLE_ADMIN);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::ROOT_UUID);

        $command = new UpdateUser(
            UserFixtures::ROOT_UUID,
            UserFixtures::ROOT_ID,
            UserFixtures::ROOT_ROLE,
            'name',
            'lastName',
            'email'
        );
        self::expectException(ActionUserActionNotAllowedException::class);

        $this->updateRootUserRule->satisfiedBy($this->actionUser,$command);

    }

    public function testRuleActionUserActionNotAllowedExceptionByUuid()
    {
        $role = new UserRole(User::ROLE_ROOT);
        $this->actionUser->method('getRole')
            ->willReturn($role);
        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $command = new UpdateUser(
            UserFixtures::ROOT_UUID,
            UserFixtures::FRODO_ID,
            UserFixtures::ROOT_ROLE,
            'name',
            'lastName',
            'email'
        );
        self::expectException(ActionUserActionNotAllowedException::class);

        $this->updateRootUserRule->satisfiedBy($this->actionUser,$command);

    }
    
}