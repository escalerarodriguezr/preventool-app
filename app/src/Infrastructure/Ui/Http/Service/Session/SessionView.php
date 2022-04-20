<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Service\Session;

use Preventool\Domain\Shared\Value\Email;
use Preventool\Domain\Shared\Value\NonEmptyString;
use Preventool\Domain\User\Model\Value\UserRole;

class SessionView
{
    const USER_ID = 'userId';
    const USER_UUID = 'userUuid';
    const EMAIL = 'email';
    const ROLE = 'role';
    const NAME = 'name';
    const LASTNAME = 'lastname';
    const TOKEN = 'token';

    public function __construct(
        public int $userId,
        public string $userUuid,
        public Email $email,
        public UserRole $role,
        public NonEmptyString $name,
        public NonEmptyString $lastName,
        public string $token
    )
    {
    }

    public function toArray():array
    {
        return [
            self::TOKEN => $this->token,
            self::USER_ID => $this->userId,
            self::USER_UUID => $this->userUuid,
            self::EMAIL => $this->email->getValue(),
            self::ROLE => $this->role->getValue(),
            self::NAME => $this->name->getValue(),
            self::LASTNAME => $this->lastName->getValue(),
        ];
    }


}