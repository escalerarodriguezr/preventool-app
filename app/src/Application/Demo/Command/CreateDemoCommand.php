<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\Command;

use Preventool\Domain\Shared\Bus\Command\Command;

class CreateDemoCommand implements Command
{
    private string $email;


    public function __construct(string $email)
    {
        $this->email = $email;
    }


    public function getEmail(): string
    {
        return $this->email;
    }


}