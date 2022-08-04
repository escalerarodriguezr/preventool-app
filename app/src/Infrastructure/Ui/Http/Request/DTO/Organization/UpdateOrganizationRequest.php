<?php

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\Organization;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateOrganizationRequest implements RequestDTO
{
    const EMAIL = 'email';
    const NAME = 'name';
    const LEGAL_DOCUMENT = 'legalDocument';
    const ADDRESS = 'address';
    const IS_ACTIVE = 'isActive';


    private ?string $name;

    /**
     * @Assert\NotBlank(allowNull = true)
     * @Assert\Email()
     */
    private ?string $email;
    private ?string $legalDocument;
    private ?string $address;
    private ?bool $isActive;


    public function __construct(Request $request)
    {

        $this->name = $request->request->get(self::NAME);
        $this->email  = $request->request->get(self::EMAIL);
        $this->legalDocument = $request->request->get(self::LEGAL_DOCUMENT);
        $this->address = $request->request->get(self::ADDRESS);
        $isActive = $request->request->get(self::IS_ACTIVE);
        $this->isActive = null;
        if(isset($isActive)){
            $this->isActive = filter_var($isActive, FILTER_VALIDATE_BOOL);
        }

    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
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

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

}