<?php

declare(strict_types=1);

namespace Src\Venue\Infrastructure;

use Illuminate\Database\Eloquent\Collection;
use Src\Venue\Application\get\GetAllVenues;
use Src\Venue\Infrastructure\Repositories\EloquentVenueRepository;

final class GetAllVenuesController
{

    private EloquentVenueRepository $repository;

    /**
     * GetAllVenuesController constructor.
     *
     * @param \Src\Venue\Infrastructure\Repositories\EloquentVenueRepository $repository
     */
    public function __construct(EloquentVenueRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        $getAllVenues = new GetAllVenues($this->repository);

        return $getAllVenues->__invoke();
    }

}
