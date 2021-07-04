<?php

declare(strict_types=1);

namespace Src\Product\Domain;

use Src\Product\Domain\ValueObjects\ProductDescription;
use Src\Product\Domain\ValueObjects\ProductName;
use Src\Product\Domain\ValueObjects\ProductPricingOptionId;
use Src\Product\Domain\ValueObjects\ProductType;

final class Product
{

    private ProductName $name;
    private ProductType $type;
    private ProductDescription $description;
    private ProductPricingOptionId $pricingOptionId;


    /**
     * Products constructor.
     *
     * @param \Src\Product\Domain\ValueObjects\ProductName            $name
     * @param \Src\Product\Domain\ValueObjects\ProductType            $type
     * @param \Src\Product\Domain\ValueObjects\ProductDescription     $description
     * @param \Src\Product\Domain\ValueObjects\ProductPricingOptionId $pricingOptionId
     */
    public function __construct(
        ProductName $name,
        ProductType $type,
        ProductDescription $description,
        ProductPricingOptionId $pricingOptionId
    ) {
        $this->name            = $name;
        $this->type            = $type;
        $this->description     = $description;
        $this->pricingOptionId = $pricingOptionId;
    }

    /**
     * @return ProductName
     */
    public function name(): ProductName
    {
        return $this->name;
    }

    /**
     * @return ProductDescription
     */
    public function description(): ProductDescription
    {
        return $this->description;
    }

    /**
     * @return ProductType
     */
    public function type(): ProductType
    {
        return $this->type;
    }

    /**
     * @return \Src\Product\Domain\ValueObjects\ProductPricingOptionId
     */
    public function pricingOptionId(): ProductPricingOptionId
    {
        return $this->pricingOptionId;
    }


    /**
     * @param \Src\Product\Domain\ValueObjects\ProductName            $name
     * @param \Src\Product\Domain\ValueObjects\ProductType            $type
     * @param \Src\Product\Domain\ValueObjects\ProductDescription     $description
     * @param \Src\Product\Domain\ValueObjects\ProductPricingOptionId $pricingOptionId
     *
     * @return \Src\Product\Domain\Product
     */
    public static function create(
        ProductName $name,
        ProductType $type,
        ProductDescription $description,
        ProductPricingOptionId $pricingOptionId
    ): Product {
        return new self($name, $type, $description, $pricingOptionId);
    }

}
