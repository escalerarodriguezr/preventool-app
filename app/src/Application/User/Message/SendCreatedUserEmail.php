<?php
declare(strict_types=1);

namespace Preventool\Application\User\Message;

use Preventool\Domain\Shared\Bus\Message\Message;

class SendCreatedUserEmail implements Message
{

    public function __construct(
        private string $email
    )
    {
    }

    public function getEmail(): string
    {
        return $this->email;
    }


}