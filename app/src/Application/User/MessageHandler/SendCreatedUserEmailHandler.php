<?php
declare(strict_types=1);

namespace Preventool\Application\User\MessageHandler;

use Preventool\Application\User\Message\SendCreatedUserEmail;
use Preventool\Domain\Shared\Bus\Message\MessageHandler;
use Preventool\Domain\Shared\Service\Mailer\Mailer;
use Preventool\Infrastructure\Mailer\TwigTemplate;

class SendCreatedUserEmailHandler implements MessageHandler
{

    public function __construct(
        private Mailer $mailer
    )
    {
    }

    public function __invoke(SendCreatedUserEmail $message)
    {
        $payload = [
            'email' => $message->getEmail()
        ];

        $this->mailer->send(
            $message->getEmail(),
            TwigTemplate::REGISTER_USER,
            $payload
        );
    }
}