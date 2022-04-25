<?php
declare(strict_types=1);

namespace Preventool\Application\User\Command;

use Preventool\Domain\Shared\Bus\Command\Command;

class UploadUserAvatar implements Command
{
    private string $uuid;
    private int $actionUserId;
    private string $actionUserRole;
    private string $avatarResource;

    public function __construct(string $uuid, int $actionUserId, string $actionUserRole, string $avatarResource)
    {
        $this->uuid = $uuid;
        $this->actionUserId = $actionUserId;
        $this->actionUserRole = $actionUserRole;
        $this->avatarResource = $avatarResource;
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }

    public function getActionUserId(): int
    {
        return $this->actionUserId;
    }

    public function getActionUserRole(): string
    {
        return $this->actionUserRole;
    }

    public function getAvatarResource(): string
    {
        return $this->avatarResource;
    }

}