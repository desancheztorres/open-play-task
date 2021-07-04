<?php

declare(strict_types=1);

namespace Src\Product\Domain\ValueObjects;

final class ProductDescription
{

    private string $value;

    /**
     * ProductType constructor.
     *
     * @param string $description
     */
    public function __construct(string $description)
    {
        $this->value = $description;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
