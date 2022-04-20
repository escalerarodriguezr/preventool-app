<?php
declare(strict_types=1);

namespace Preventool\Domain\Demo\Repository;

use Preventool\Domain\Demo\Model\Entity\Demo;

interface DemoRepository
{
    public function find(int $id): ?Demo;
    public function save(Demo $user): void;
    public function remove(Demo $user): void;
    public function findByEmail(string $email): ?Demo;

}