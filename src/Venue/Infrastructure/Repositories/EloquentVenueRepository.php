<?php

declare(strict_types=1);

namespace Src\Venue\Infrastructure\Repositories;

use App\Models\VenueModel as EloquentVenueModel;
use Illuminate\Database\Eloquent\Collection;
use Src\Venue\Domain\Contracts\VenueRepository;
use Src\Venue\Domain\ValueObjects\VenueId;

final class EloquentVenueRepository implements VenueRepository
{

    /**
     * @var \App\Models\VenueModel
     */
    private EloquentVenueModel $eloquentVenueModel;

    /**
     * EloquentVenueRepository constructor.
     */
    public function __construct()
    {
        $this->eloquentVenueModel = new EloquentVenueModel;
    }

    public function all(): ?Collection
    {
        return $this->eloquentVenueModel->get();
    }


    /**
     * @param \Src\Venue\Domain\ValueObjects\VenueId $id
     *
     * @return mixed
     */
    public function find(VenueId $id)
    {
        return $this->eloquentVenueModel->findOrFail($id->value());
    }

}
