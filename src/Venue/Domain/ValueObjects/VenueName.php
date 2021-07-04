<?php

declare(strict_types=1);

namespace Src\Venue\Domain\ValueObjects;

final class VenueName
{

    private string $value;

    /**
     * ProductName constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->value = $name;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
