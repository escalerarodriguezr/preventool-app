<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\Event;

use Preventool\Domain\Shared\Bus\Event\Event;

class DemoCreatedEvent implements Event
{
    private int $demoId;

    public function __construct(int $demoId)
    {
        $this->demoId = $demoId;
    }

    public function getDemoId(): int
    {
        return $this->demoId;
    }




}