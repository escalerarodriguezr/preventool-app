<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\Demo;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class DemoRequest implements RequestDTO
{
    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private ?string $email;

    public function __construct(Request $request)
    {
        $this->email = $request->request->get('email');
    }


    public function getEmail(): string
    {
        return $this->email;
    }

}