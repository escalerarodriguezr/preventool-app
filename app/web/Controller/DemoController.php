<?php
declare(strict_types=1);

namespace App\Controller;

use Preventool\Application\Demo\Command\CreateDemoCommand;
use Preventool\Domain\Shared\Bus\Command\CommandBus;
use Preventool\Infrastructure\Ui\Http\Request\DTO\Demo\DemoRequest;

class DemoController
{
    public function __construct(private CommandBus $commandBus)
    {
    }

    public function __invoke(DemoRequest $demoRequest)
    {
        $createDemoCommand = new CreateDemoCommand($demoRequest->getEmail());
        $this->commandBus->dispatch($createDemoCommand);
    }

}