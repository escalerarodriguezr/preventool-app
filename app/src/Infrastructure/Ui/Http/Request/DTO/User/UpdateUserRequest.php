<?php

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequest implements RequestDTO
{
    const EMAIL = 'email';
    const NAME = 'name';
    const LASTNAME = 'lastName';

    /**
     * @Assert\NotBlank(allowNull = true)
     */
    private ?string $name;

    /**
     * @Assert\NotBlank(allowNull = true)
     */
    private ?string $lastName;

    /**
     * @Assert\NotBlank(allowNull = true)
     * @Assert\Email()
     */
    private ?string $email;

    public function __construct(Request $request)
    {
        $this->name = $request->request->get(self::NAME);
        $this->lastName = $request->request->get(self::LASTNAME);
        $this->email = $request->request->get(self::EMAIL);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

}