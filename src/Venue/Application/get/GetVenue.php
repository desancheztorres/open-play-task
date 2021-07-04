<?php

declare(strict_types=1);

namespace Src\Venue\Application\get;

use Src\Venue\Domain\Contracts\VenueRepository;
use Src\Venue\Domain\ValueObjects\VenueId;

class GetVenue
{

    private VenueRepository $repository;

    /**
     * @param \Src\Venue\Domain\Contracts\VenueRepository $repository
     */
    public function __construct(VenueRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * @param int $memberId
     *
     * @return mixed
     */
    public function __invoke(int $memberId)
    {
        $id = new VenueId($memberId);

        return $this->repository->find($id);

    }

}
