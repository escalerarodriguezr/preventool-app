<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\User\Service\CreateUserRules\Rules;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Preventool\Application\User\Command\CreateUser;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\CreateUserRules\Rules\CreateRootUserRule;

class CreateRootUserRuleTest extends TestCase
{
    private MockObject|User $actionUser;
    private CreateRootUserRule $service;

    protected function setUp():void
    {
        parent::setUp();
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new CreateRootUserRule();
    }

    public function testRuleActionUserActionNotAllowedException()
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

        self::expectException(ActionUserActionNotAllowedException::class);

        $this->service->satisfiedBy($this->actionUser, $command);

    }

    public function testRuleActionUserNotException()
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

        $this->service->satisfiedBy($this->actionUser, $command);
        self::assertEquals(1,1);

    }

}