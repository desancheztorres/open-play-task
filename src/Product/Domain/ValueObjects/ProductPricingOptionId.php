<?php

declare(strict_types=1);

namespace Src\Product\Domain\ValueObjects;

final class ProductPricingOptionId
{

    private int $value;

    /**
     * ProductPricingOptionId constructor.
     *
     * @param int $pricingOptionId
     */
    public function __construct(int $pricingOptionId)
    {
        $this->value = $pricingOptionId;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->value;
    }

}
