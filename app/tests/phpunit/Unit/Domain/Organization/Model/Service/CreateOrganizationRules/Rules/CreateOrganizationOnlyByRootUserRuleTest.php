<?php

namespace PHPUnit\Tests\Unit\Domain\Organization\Model\Service\CreateOrganizationRules\Rules;

use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\Organization\Model\CreateOrganizationRules\Rules\CreateOrganizationOnlyByRootUserRule;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Value\UserRole;

class CreateOrganizationOnlyByRootUserRuleTest extends TestCase
{
    private MockClass|User $actionUser;
    private CreateOrganizationOnlyByRootUserRule $rule;

    protected function setUp():void
    {
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->rule = new CreateOrganizationOnlyByRootUserRule();
        parent::setUp();
    }

    public function testCreateOrganizationByAdminUser():void
    {
        $adminRole = new UserRole(User::ROLE_ADMIN);
        $this->actionUser->method('getRole')
            ->willReturn($adminRole);
        self::expectException(ActionUserActionNotAllowedException::class);
        $this->rule->satisfiedBy($this->actionUser);
    }

    public function testCreateOrganizationByRootUser()
    {
        $rootRole = new UserRole(User::ROLE_ROOT);
        $this->actionUser->method('getRole')
            ->willReturn($rootRole);
        $this->rule->satisfiedBy($this->actionUser);
        self::assertEquals(1,1);
    }


}