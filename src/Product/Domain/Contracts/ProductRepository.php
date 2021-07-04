<?php

declare(strict_types=1);

namespace Src\Product\Domain\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Src\Product\Domain\Product;
use Src\Product\Domain\ValueObjects\ProductId;
use Src\Product\Domain\ValueObjects\ProductName;

interface ProductRepository
{

    public function all(): ?Collection;

    public function find(ProductId $id);

    public function findByCriteria(ProductName $name): ?Product;

    public function getPricingOptions(ProductId $id);


}
