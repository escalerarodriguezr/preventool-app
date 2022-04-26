<?php
declare(strict_types=1);

namespace Preventool\Application\User\QueryHandler\SearchUserQueryHandler;

class SearchUserQueryView
{
    public function __construct(
        private int $total,
        private int $pages,
        private int $currentPage,
//        private \ArrayIterator $items
    )
    {

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

    public function toArray(): array
    {
        return [
            'total' => $this->total,
            'pages' => $this->pages,
            'currentPage' => $this->currentPage,
//            'users' => array_map(function (User $entity): array {
//                return $entity->toArray();
//            }, $this->getItems()->getArrayCopy()),

        ];
    }

}