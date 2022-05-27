<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\Organization;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class CreateOrganizationRequest implements RequestDTO
{
    const EMAIL = 'email';
    const NAME = 'name';
    const LEGAL_DOCUMENT = 'legalDocument';
    const ADDRESS = 'address';

    /**
     * @Assert\NotBlank()
     */
    private ?string $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private ?string $email;

    private ?string $legalDocument;
    private ?string $address;


    public function __construct(Request $request)
    {
        $this->name = trim($request->request->get(self::NAME));
        $this->email  = $request->request->get(self::EMAIL);
        $this->legalDocument = $request->request->get(self::LEGAL_DOCUMENT);
        $this->address = $request->request->get(self::ADDRESS);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getLegalDocument(): ?string
    {
        return $this->legalDocument;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

}