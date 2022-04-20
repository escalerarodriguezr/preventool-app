<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use Preventool\Domain\User\Model\Entity\User;
use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateUserRequest implements RequestDTO
{
    const ROLES_CHOICE = [
        User::ROLE_ROOT,
        User::ROLE_ADMIN,
    ];

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private ?string $email;

    /**
     * @Assert\NotBlank()
     * @Assert\Length(min=6)
     */
    private ?string $password;

    /**
     * @Assert\NotBlank()
     * * @Assert\Choice(choices=CreateUserRequest::ROLES_CHOICE, message="Choose a valid role.")
     */
    private ?string $role;

    /**
     * @Assert\NotBlank()
     */
    private ?string $name;

    /**
     * @Assert\NotBlank()
     */
    private ?string $lastName;


    public function __construct(Request $request)
    {
        $this->email = $request->request->get('email');
        $this->password = $request->request->get('password');
        $this->role = $request->request->get('role');
        $this->name = $request->request->get('name');
        $this->lastName = $request->request->get('lastName');
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