<?php

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\Company;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class UpdateCompanyRequest implements RequestDTO
{
    const NAME = 'name';
    const LEGAL_DOCUMENT = 'legalDocument';
    const ADDRESS = 'address';

    /**
     * @Assert\NotBlank(allowNull = true)
     */
    private ?string $name;
    private ?string $legalDocument;
    private ?string $address;


    public function __construct(Request $request)
    {
        $this->name = trim($request->request->get(self::NAME));
        $this->legalDocument = $request->request->get(self::LEGAL_DOCUMENT);
        $this->address = $request->request->get(self::ADDRESS);
    }

    public function getName(): ?string
    {
        return $this->name;
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