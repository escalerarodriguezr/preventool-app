<?php
declare(strict_types=1);

namespace Preventool\Domain\User\Repository;

use DateTimeZone;

class UserFilter
{
    public function __construct(
        private ?string $filterByUuid = null,
        private ?string  $filterByEmail = null,
        private ?bool $filterByIsActive = null,
        private ?string $filterByCreatedOnFrom = null
    )
    {

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

    public function getFilterByCreatedOnFrom(): ?\DateTime
    {
        if(empty($this->filterByCreatedOnFrom)){
            return null;
        }

        try{
            return (new \DateTime($this->filterByCreatedOnFrom))->setTimezone(new DateTimeZone("UTC"));
        }catch (\Exception){
            return null;
        }
    }

}