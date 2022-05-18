<?php

namespace PHPUnit\Tests\Unit\Domain\User\Service\UpdateUserRules\Rules;

use PHPUnit\Framework\MockObject\MockClass;
use PHPUnit\Framework\TestCase;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Domain\User\Model\Exception\ActionUserActionNotAllowedException;
use Preventool\Domain\User\Model\Service\UpdateUserRules\Rules\CanNotDeactivateItSelf;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;

class CanNotDeactivateItSelfTest extends TestCase
{
    private MockClass|User $actionUser;
    private CanNotDeactivateItSelf $rule;

    protected function setUp():void
    {
        parent::setUp();

        $this->actionUser = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->actionUser->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        $this->rule = new CanNotDeactivateItSelf();
    }

    public function testCanNotDeactivateItself()
    {
        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $user->method('getUuid')
            ->willReturn(UserFixtures::FRODO_UUID);

        self::expectException(ActionUserActionNotAllowedException::class);

        $this->rule->satisfiedBy($this->actionUser,$user);
    }

    public function testCanDeactivateOtherUser()
    {
        $user = $this->getMockBuilder(User::class)
            ->disableOriginalConstructor()
            ->getMock();
        $user->method('getUuid')
            ->willReturn(UserFixtures::FAKE_UUID);

        $this->rule->satisfiedBy($this->actionUser,$user);
        self::assertEquals(1,1);
    }
}