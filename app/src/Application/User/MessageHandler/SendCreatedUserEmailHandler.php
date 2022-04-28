<?php
declare(strict_types=1);

namespace Preventool\Application\User\MessageHandler;

use Preventool\Application\User\Message\SendCreatedUserEmail;
use Preventool\Domain\Shared\Bus\Message\MessageHandler;
use Psr\Log\LoggerInterface;

class SendCreatedUserEmailHandler implements MessageHandler
{

    public function __construct(
        private LoggerInterface $logger
    )
    {
    }

    public function __invoke(SendCreatedUserEmail $message)
    {
        $this->logger->info(sprintf("Send email to: %s", $message->getEmail()));
    }


}