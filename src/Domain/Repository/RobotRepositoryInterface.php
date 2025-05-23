<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Robot;
use App\Application\DTO\ApiFiltersDTO;

interface RobotRepositoryInterface
{
    public function findAll(ApiFiltersDTO $apiFiltersDTO): array;

    public function findOneBy(int $id): ?Robot;
}
