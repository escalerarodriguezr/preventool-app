<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\CommandHandler;

use Preventool\Application\Organization\Command\CreateOrganization;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;

class CreateOrganizationHandler implements CommandHandler
{


    public function __construct()
    {
    }

    public function __invoke(CreateOrganization $createOrganization):void
    {
        dd("llega al handler", $createOrganization);
        // TODO: Implement __invoke() method.
    }


}