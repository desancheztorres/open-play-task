<?php

declare(strict_types=1);

namespace Src\Venue\Domain\ValueObjects;

final class VenueLocation
{

    private string $value;

    /**
     * ProductName constructor.
     *
     * @param string $location
     */
    public function __construct(string $location)
    {
        $this->value = $location;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
