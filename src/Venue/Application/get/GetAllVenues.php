<?php

declare(strict_types=1);

namespace Src\Venue\Application\get;

use Illuminate\Database\Eloquent\Collection;
use Src\Venue\Domain\Contracts\VenueRepository;

final class GetAllVenues
{

    private VenueRepository $repository;


    /**
     * GetAllVenues constructor.
     *
     * @param \Src\Venue\Domain\Contracts\VenueRepository $repository
     */
    public function __construct(VenueRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        return $this->repository->all();
    }

}
