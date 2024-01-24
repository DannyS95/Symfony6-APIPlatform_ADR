<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\RobotDanceOff;
use App\Infrastructure\DTO\ApiFiltersDTO;
use Doctrine\Persistence\ManagerRegistry;
use App\Infrastructure\Repository\DoctrineRepository;
use App\Domain\Repository\RobotDanceOffRepositoryInterface;

class RobotDanceOffRepository extends DoctrineRepository implements RobotDanceOffRepositoryInterface
{
    private const ALIAS = 'robotDanceOff';
    private const ENTITY = RobotDanceOff::class;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct(registry: $registry, entityClass: self::ENTITY, entityAlias: self::ALIAS);
    }

    public function findAll(ApiFiltersDTO $apiFiltersDTO): array
    {
       return $this->buildClauses(filters: $apiFiltersDTO->getFilters(), operations: $apiFiltersDTO->getOperations())
            ->buildSorts($apiFiltersDTO->getSorts())
            ->buildPagination($apiFiltersDTO->getPage(), $apiFiltersDTO->getItemsPerPage())
            ->fetchArray();
    }
}