<?php
declare(strict_types=1);

namespace Preventool\Infrastructure\Ui\Http\Request\DTO\User;

use Preventool\Infrastructure\Ui\Http\Request\RequestDTO;
use Symfony\Component\HttpFoundation\Request;

class SearchUserRequest implements RequestDTO
{
    private ?string $filterByUuid;
    private ?string $filterByEmail;
    private ?bool $filterByIsActive;

    public function __construct(Request $request)
    {
        $this->filterByUuid = empty($request->query->get('filterByUuid')) ? null : (string)$request->query->get('filterByUuid');
        $this->filterByEmail = empty($request->query->get('filterByEmail')) ? null : (string)$request->query->get('filterByEmail');

        $this->filterByIsActive = true;
        if (empty($request->query->get('filterByIsActive'))) {
            $this->filterByIsActive = null;
        }
        if ($request->query->get('filterByIsActive') == "false") {
            $this->filterByIsActive = false;
        }
    }

    public function getFilterByUuid(): ?string
    {
        return $this->filterByUuid;
    }

    public function getFilterByEmail(): ?string
    {
        return $this->filterByEmail;
    }

    public function getFilterByIsActive(): ?bool
    {
        return $this->filterByIsActive;
    }

}