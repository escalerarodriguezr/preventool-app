<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\User\Service\CreateUserRules\Rules;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\CreateUserRules\Rules\CreateAdminUserActionUserRoleRule;
use Preventool\Domain\User\Model\Value\UserRole;

class CreateAdminUserActionUserRoleRuleTest extends TestCase
{
    private MockObject|User $actionUser;
    private  CreateAdminUserActionUserRoleRule $service;

    protected function setUp():void
    {
        parent::setUp();
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new CreateAdminUserActionUserRoleRule();
    }

    public function testRuleActionUserActionRoleAdminCommandRoleAdmin()
    {
        $command = new CreateUser(
            1,
            "email@email.com",
            "qwertyuiop",
            User::ROLE_ADMIN,
            "name",
            "lastName"
        );

        $this->actionUser->method('getUuid')
            ->willReturn("03df8a4e-4598-4033-9bbf-8cd90d7b1f36");
        $this->actionUser->method('getRole')
            ->willReturn(new UserRole(User::ROLE_ADMIN));

        self::expectException(ActionUserActionNotAllowedException::class);

        $this->service->satisfiedBy($this->actionUser, $command);

    }


    public function testRuleActionUserActionRoleRootCommandRoleAdmin()
    {
        $command = new CreateUser(
            1,
            "email@email.com",
            "qwertyuiop",
            User::ROLE_ADMIN,
            "name",
            "lastName"
        );

        $this->actionUser->method('getUuid')
            ->willReturn("03df8a4e-4598-4033-9bbf-8cd90d7b1f36");
        $this->actionUser->method('getRole')
            ->willReturn(new UserRole(User::ROLE_ROOT));

        $this->service->satisfiedBy($this->actionUser, $command);

        self::assertEquals(1,1);

    }

    public function testRuleActionUserActionRoleRootCommandRoleNotAdmin()
    {
        $command = new CreateUser(
            1,
            "email@email.com",
            "qwertyuiop",
            User::ROLE_ROOT,
            "name",
            "lastName"
        );

        $this->actionUser->method('getUuid')
            ->willReturn("03df8a4e-4598-4033-9bbf-8cd90d7b1f36");
        $this->actionUser->method('getRole')
            ->willReturn(new UserRole(User::ROLE_ROOT));

        $this->service->satisfiedBy($this->actionUser, $command);

        self::assertEquals(1,1);

    }






}