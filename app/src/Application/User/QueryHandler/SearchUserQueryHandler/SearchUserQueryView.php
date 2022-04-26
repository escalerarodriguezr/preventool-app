<?php
declare(strict_types=1);

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

use DateTimeInterface;
use Preventool\Domain\User\Model\Entity\User;

class SearchUserQueryView
{
    private array $users;

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
        $this->users = array_map(function (User $userEntity):array{
            return (new UserQueryView())
                ->setId($userEntity->getId())
                ->setUuid($userEntity->getUuid())
                ->setName($userEntity->getName()->getValue())
                ->setLastName($userEntity->getLastName()->getValue())
                ->setEmail($userEntity->getEmail()->getValue())
                ->setRole($userEntity->getRole()->getValue())
                ->setCreatorUuid(!empty($userEntity->getCreator()) ? $userEntity->getCreator()->getUuid() : null)
                ->setCreatedOn($userEntity->getCreatedOn()->format(DateTimeInterface::RFC3339))
                ->setUpdatedOn($userEntity->getUpdatedOn()->format(DateTimeInterface::RFC3339))
                ->setIsActive($userEntity->isActive())
                ->setIsEmailConfirmed($userEntity->isEmailConfirmed())
                ->toArray();

        }, $items->getArrayCopy());

    }

    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'pages' => $this->pages,
            'currentPage' => $this->currentPage,
            'items' => $this->users
        ];
    }

}