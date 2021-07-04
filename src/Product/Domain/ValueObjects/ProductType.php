<?php

declare(strict_types=1);

namespace Src\Product\Domain\ValueObjects;

final class ProductType
{

    private string $value;

    /**
     * ProductType constructor.
     *
     * @param string $type
     */
    public function __construct(string $type)
    {
        $this->value = $type;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

}
