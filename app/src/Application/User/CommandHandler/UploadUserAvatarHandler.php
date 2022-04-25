<?php
declare(strict_types=1);

namespace Preventool\Application\User\CommandHandler;

use Preventool\Application\User\Command\UploadUserAvatar;
use Preventool\Domain\Shared\Bus\Command\CommandHandler;

class UploadUserAvatarHandler implements CommandHandler
{


    public function __construct()
    {
    }

    public function __invoke(UploadUserAvatar $command):void
    {
        // TODO: Implement __invoke() method.
    }


}