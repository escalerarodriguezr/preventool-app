<?php
declare(strict_types=1);

namespace Preventool\Domain\Shared\Bus\Message;

abstract class RoutingKey
{
    public const PREVENTOOL_PREVENTOOL_QUEUE = 'main_queue';
}