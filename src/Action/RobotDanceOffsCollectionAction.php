<?php

namespace App\Action;

use App\Action\AbstractAction;
use App\Domain\Service\RobotService;
use App\Infrastructure\DTO\ApiFiltersDTO;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
final class RobotDanceOffsCollectionAction extends AbstractAction
{
    public function __construct(private RobotService $robotService)
    {
    }

    public function __invoke(Request $request): Collection
    {
        parent::__construct(request: $request);

        $filters = $this->filters();

        $operations = $this->operations();

        $sorts = $this->sorts();

        $page = $request->query->get('page');

        $itemsPerPage = $request->query->get('itemsPerPage');

        $apiFiltersDTO = new ApiFiltersDTO(sorts: $sorts, filters: $filters, operations: $operations, page: $page, itemsPerPage: $itemsPerPage);

        $models = $this->robotService->getRobotDanceOffs($apiFiltersDTO);

        return new ArrayCollection($models);
    }
}
