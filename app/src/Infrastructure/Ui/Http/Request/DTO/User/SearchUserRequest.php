<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;

class SearchUserRequest implements RequestDTO
{
    private ?string $filterByUuid;
    private ?string $filterByEmail;

    public function __construct(Request $request)
    {
        $this->filterByUuid = empty($request->query->get('filterByUuid')) ? null : (string)$request->query->get('filterByUuid');
        $this->filterByEmail = empty($request->query->get('filterByEmail')) ? null : (string)$request->query->get('filterByEmail');
    }

    public function getFilterByUuid(): ?string
    {
        return $this->filterByUuid;
    }

    public function getFilterByEmail(): ?string
    {
        return $this->filterByEmail;
    }

}