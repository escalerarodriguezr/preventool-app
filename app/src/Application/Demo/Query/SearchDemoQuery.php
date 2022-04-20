<?php
declare(strict_types=1);

namespace Preventool\Application\Demo\Query;

use Preventool\Domain\Shared\Bus\Query\Query;

class SearchDemoQuery implements Query
{
    private ?string $filterByEmail;


    public function getFilterByEmail(): ?string
    {
        return $this->filterByEmail;
    }

    public function setFilterByEmail(?string $filterByEmail): void
    {
        $this->filterByEmail = $filterByEmail;
    }




}