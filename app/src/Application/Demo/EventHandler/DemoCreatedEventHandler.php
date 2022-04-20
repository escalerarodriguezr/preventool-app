<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\EventHandler;

use Preventool\Application\Demo\Event\DemoCreatedEvent;
use Preventool\Domain\Demo\Model\Entity\Demo;
use Preventool\Domain\Demo\Repository\DemoRepository;
use Preventool\Domain\Shared\Bus\Event\EventHandler;

class DemoCreatedEventHandler implements EventHandler
{
    public function __construct(
        private DemoRepository $demoRepository,
    )
    {
    }

    public function __invoke(DemoCreatedEvent $demoCreatedEvent)
    {
        $demoEntity = new Demo("otro@otro.com");
        $this->demoRepository->save($demoEntity);
    }


}