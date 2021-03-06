<?php

namespace Preventool\Domain\User\Repository;

use Preventool\Domain\Shared\Repository\QueryCondition\QueryCondition;
use Preventool\Domain\Shared\Repository\View\PaginatedQueryView;
use Preventool\Domain\User\Model\Entity\User;

interface UserRepository
{
    public function save(User $user): void;
    public function find(int $id): ?User;
    public function findByUuid(string $uuid): ?User;
    public function findByEmail(string $email): ?User;
    public function searchPaginated(QueryCondition $queryCondition, UserFilter$userFilter): PaginatedQueryView;
}