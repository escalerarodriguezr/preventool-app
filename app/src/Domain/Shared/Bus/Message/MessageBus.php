<?php
declare(strict_types=1);

namespace Preventool\Domain\Shared\Bus\Message;

interface MessageBus
{
    public function dispatch(Message $message): void;

}