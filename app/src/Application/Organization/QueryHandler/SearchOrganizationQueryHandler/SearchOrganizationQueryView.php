<?php
declare(strict_types=1);

namespace Preventool\Application\Organization\QueryHandler\SearchOrganizationQueryHandler;

use DateTimeInterface;
use Preventool\Domain\Organization\Model\Entity\Organization;

class SearchOrganizationQueryView
{
    private array $organizations;

    public function __construct(
        private int $total,
        private int $pages,
        private int $currentPage,
        private \ArrayIterator $items,

    )
    {
        $this->transformItems($this->items);
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getPages(): int
    {
        return $this->pages;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getItems(): \ArrayIterator
    {
        return $this->items;
    }

    private function transformItems(\ArrayIterator $items):void
    {
        $this->organizations = array_map(function (Organization $organizationEntity):array{
            return (new OrganizationQueryView())
                ->setId($organizationEntity->getId())
                ->setUuid($organizationEntity->getUuid())
                ->setName($organizationEntity->getName()->getValue())
                ->setLegalDocument($organizationEntity->getLegalDocument())
                ->setEmail($organizationEntity->getEmail()->getValue())
                ->setAddress($organizationEntity->getAddress())
                ->setCreatedOn($organizationEntity->getCreatedOn()->format(DateTimeInterface::RFC3339))
                ->setUpdatedOn($organizationEntity->getUpdatedOn()->format(DateTimeInterface::RFC3339))
                ->setIsActive($organizationEntity->isActive())
                ->toArray();

        }, $items->getArrayCopy());

    }

    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'pages' => $this->pages,
            'currentPage' => $this->currentPage,
            'items' => $this->organizations
        ];
    }

}