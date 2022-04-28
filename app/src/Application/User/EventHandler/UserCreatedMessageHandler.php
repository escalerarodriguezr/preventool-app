<?php

namespace Preventool\Application\User\EventHandler;

use Preventool\Application\User\Event\UserCreated;
use Preventool\Application\User\Message\SendCreatedUserEmail;
use Preventool\Domain\Shared\Bus\Event\EventHandler;
use Preventool\Domain\Shared\Bus\Message\MessageBus;
use Psr\Log\LoggerInterface;

class UserCreatedMessageHandler implements EventHandler
{


    public function __construct(
        private LoggerInterface $logger,
        private MessageBus $messageBus

    )
    {
    }

    public function __invoke(UserCreated $userCreated):void
    {
        $m = new SendCreatedUserEmail($userCreated->getEmail());


        $this->messageBus->dispatch(
            new SendCreatedUserEmail($userCreated->getEmail())
        );



        // TODO: Implement __invoke() method.
    }


}