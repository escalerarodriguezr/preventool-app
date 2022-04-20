<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Bus\SymfonyMessenger;

use Preventool\Domain\Shared\Bus\Event\Event;
use Preventool\Domain\Shared\Bus\Event\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;

final class MessengerEventBus implements EventBus
{
    public function __construct(private MessageBusInterface $eventBus)
    {
    }

    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }


}