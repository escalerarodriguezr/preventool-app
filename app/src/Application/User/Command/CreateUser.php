<?php
declare(strict_types=1);

namespace Preventool\Application\User\Command;

use Preventool\Domain\Shared\Bus\Command\Command;

class CreateUser implements Command
{
    private int $actionUserId;
    private string $email;
    private string $password;
    private string $role;
    private string $name;
    private string $lastName;

    public function __construct(
        int $actionUserId,
        string $email,
        string $password,
        string $role,
        string $name,
        string $lasName
    )
    {
        $this->actionUserId = $actionUserId;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->name = $name;
        $this->lastName = $lasName;
    }

    public function getActionUserId(): int
    {
        return $this->actionUserId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

}