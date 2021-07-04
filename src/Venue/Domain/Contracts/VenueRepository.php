<?php

declare(strict_types=1);

namespace Src\Venue\Domain\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Src\Venue\Domain\ValueObjects\VenueId;

interface VenueRepository
{

    public function all(): ?Collection;

    public function find(VenueId $id);

}
