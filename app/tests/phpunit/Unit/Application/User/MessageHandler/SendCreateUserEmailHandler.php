<?php

namespace PHPUnit\Tests\Unit\Application\User\MessageHandler;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Preventool\Application\User\Message\SendCreatedUserEmail;
use Preventool\Application\User\MessageHandler\SendCreatedUserEmailHandler;
use Preventool\Domain\Shared\Service\Mailer\Mailer;
use Preventool\Infrastructure\Mailer\TwigTemplate;
use Preventool\Infrastructure\Persistence\Doctrine\DataFixtures\UserFixtures;

class SendCreateUserEmailHandler extends TestCase
{
    private MockObject|Mailer $mailer;
    private SendCreatedUserEmailHandler $service;

    protected function setUp():void
    {
        parent::setUp();
        $this->mailer = $this->getMockBuilder(Mailer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->service = new SendCreatedUserEmailHandler($this->mailer);
    }

    public function testInvoke()
    {
        $message = new SendCreatedUserEmail(
            UserFixtures::ROOT_EMAIL
        );

        $this->mailer->expects($this->exactly(1))
            ->method('send')
            ->with($message->getEmail(),TwigTemplate::REGISTER_USER, $this->isType('array'));
        $this->service->__invoke($message);
    }
}