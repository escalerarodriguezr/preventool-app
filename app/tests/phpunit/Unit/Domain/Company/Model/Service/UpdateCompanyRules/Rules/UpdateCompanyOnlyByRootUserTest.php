<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Unit\Domain\Company\Model\Service\UpdateCompanyRules\Rules;

use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\Company\Model\Service\UpdateCompanyRules\Rules\UpdateCompanyOnlyByRootUserRule;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Value\UserRole;

class UpdateCompanyOnlyByRootUserTest extends TestCase
{
    private MockClass|User $actionUser;
    private UpdateCompanyOnlyByRootUserRule $rule;

    protected function setUp():void
    {
        parent::setUp();
        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->rule = new UpdateCompanyOnlyByRootUserRule();
    }

    public function testRootActionUserCanUpdateCompany():void
    {
        $actionUserRole = new UserRole(User::ROLE_ROOT);

        $this->actionUser->method('getRole')
            ->willReturn($actionUserRole);
        $this->rule->satisfiedBy($this->actionUser);
        self::assertEquals(1,1);
    }

    public function testAdminActionUserCanNotUpdateCompany():void
    {
        $actionUserRole = new UserRole(User::ROLE_ADMIN);
        $this->actionUser->method('getRole')
            ->willReturn($actionUserRole);
        self::expectException(ActionUserActionNotAllowedException::class);
        $this->rule->satisfiedBy($this->actionUser);
    }

}