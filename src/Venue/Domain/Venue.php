<?php

declare(strict_types=1);

namespace Src\Venue\Domain;


use Src\Venue\Domain\ValueObjects\VenueLocation;
use Src\Venue\Domain\ValueObjects\VenueName;

final class Venue
{

    private VenueName $name;
    private VenueLocation $location;


    /**
     * Venue constructor.
     *
     * @param \Src\Venue\Domain\ValueObjects\VenueName     $name
     * @param \Src\Venue\Domain\ValueObjects\VenueLocation $location
     */
    public function __construct(
        VenueName $name,
        VenueLocation $location
    ) {
        $this->name     = $name;
        $this->location = $location;
    }


    /**
     * @return \Src\Venue\Domain\ValueObjects\VenueName
     */
    public function name(): VenueName
    {
        return $this->name;
    }

    /**
     * @return \Src\Venue\Domain\ValueObjects\VenueLocation
     */
    public function location(): VenueLocation
    {
        return $this->location;
    }

    /**
     * @param \Src\Venue\Domain\ValueObjects\VenueName     $name
     * @param \Src\Venue\Domain\ValueObjects\VenueLocation $location
     *
     * @return \Src\Venue\Domain\Venue
     */
    public static function create(
        VenueName $name,
        VenueLocation $location
    ): Venue {
        return new self($name, $location);
    }

}
