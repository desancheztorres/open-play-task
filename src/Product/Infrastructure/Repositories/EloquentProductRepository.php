<?php

declare(strict_types=1);

namespace Src\Product\Infrastructure\Repositories;

use App\Models\ProductModel as EloquentProductModel;
use Illuminate\Database\Eloquent\Collection;
use Src\Product\Domain\Contracts\ProductRepository;
use Src\Product\Domain\Product;
use Src\Product\Domain\ValueObjects\ProductDescription;
use Src\Product\Domain\ValueObjects\ProductId;
use Src\Product\Domain\ValueObjects\ProductName;
use Src\Product\Domain\ValueObjects\ProductPricingOptionId;
use Src\Product\Domain\ValueObjects\ProductType;

final class EloquentProductRepository implements ProductRepository
{

    /**
     * @var \App\Models\ProductModel
     */
    private EloquentProductModel $eloquentProductModel;

    /**
     * EloquentProductRepository constructor.
     */
    public function __construct()
    {
        $this->eloquentProductModel = new EloquentProductModel;
    }

    public function all(): ?Collection
    {
        return $this->eloquentProductModel->get();
    }

    /**
     * @param \Src\Product\Domain\ValueObjects\ProductId $id
     *
     * @return mixed
     */
    public function find(ProductId $id)
    {
        return $this->eloquentProductModel->findOrFail($id->value());
    }

    /**
     * @param \Src\Product\Domain\ValueObjects\ProductName $name
     *
     * @return \Src\Product\Domain\Product|null
     */
    public function findByCriteria(ProductName $name): ?Product
    {
        return $this->eloquentProductModel
            ->where('name', $name->value())
            ->firstOrFail();
    }

    public function getPricingOptions(ProductId $id)
    {
        $product = $this->eloquentProductModel->findOrFail($id->value());

        return $product->pricingOption;
    }

}
