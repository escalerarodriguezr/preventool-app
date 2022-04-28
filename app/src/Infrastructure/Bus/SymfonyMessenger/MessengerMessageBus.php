<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Bus\SymfonyMessenger;


use Preventool\Domain\Shared\Bus\Message\Message;
use Preventool\Domain\Shared\Bus\Message\MessageBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerMessageBus implements MessageBus
{

    public function __construct(private MessageBusInterface $messageBus)
    {
    }

    public function dispatch(Message $message): void
    {
        $this->messageBus->dispatch($message);
    }


}