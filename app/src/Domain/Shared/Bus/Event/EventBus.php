<?php

namespace Preventool\Domain\Shared\Bus\Event;

interface EventBus
{
    public function dispatch(Event $event): void;
}