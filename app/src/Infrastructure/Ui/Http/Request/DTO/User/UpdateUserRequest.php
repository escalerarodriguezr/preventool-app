<?php

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use phpDocumentor\Reflection\Types\Boolean;
use Preventool\Domain\User\Model\Entity\User;
use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateUserRequest implements RequestDTO
{
    const ROLES_CHOICE = [
        User::ROLE_ROOT,
        User::ROLE_ADMIN,
    ];

    const EMAIL = 'email';
    const NAME = 'name';
    const LASTNAME = 'lastName';
    const IS_ACTIVE = 'isActive';
    const ROLE = 'role';

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

    private ?bool $isActive;

    /**
     * @Assert\NotBlank(allowNull = true)
     * * @Assert\Choice(choices=CreateUserRequest::ROLES_CHOICE, message="Choose a valid role.")
     */
    private ?string $role;

    public function __construct(Request $request)
    {

        $this->name = $request->request->get(self::NAME);
        $this->lastName = $request->request->get(self::LASTNAME);
        $this->email = $request->request->get(self::EMAIL);
        $isActive = $request->request->get(self::IS_ACTIVE);
        $this->role = $request->request->get(self::ROLE);
        $this->isActive = null;
        if((isset($isActive) && !empty(trim($isActive))) || (isset($isActive) && $isActive == 0 )){
            $this->isActive = filter_var($isActive, FILTER_VALIDATE_BOOL);
        }

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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

}