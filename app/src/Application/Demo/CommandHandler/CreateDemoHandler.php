<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\CommandHandler;

use Preventool\Application\Demo\Command\CreateDemoCommand;
use Preventool\Application\Demo\Event\DemoCreatedEvent;
use Preventool\Domain\Demo\Model\Entity\Demo;
use Preventool\Domain\Demo\Repository\DemoRepository;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;
use Preventool\Domain\Shared\Bus\Event\EventBus;

class CreateDemoHandler implements CommandHandler
{

    public function __construct(
        private DemoRepository $demoRepository,
        private EventBus $eventBus
    )
    {
    }

    public function __invoke(CreateDemoCommand $createDemoCommand): void
    {
        $demoEntity = new Demo($createDemoCommand->getEmail());
        $this->demoRepository->save($demoEntity);
        $this->eventBus->dispatch(new DemoCreatedEvent(25));

    }


}