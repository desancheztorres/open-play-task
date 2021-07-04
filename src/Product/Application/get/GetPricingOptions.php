<?php

declare(strict_types=1);

namespace Src\Product\Application\get;

use Src\Product\Domain\Contracts\ProductRepository;
use Src\Product\Domain\ValueObjects\ProductId;

class GetPricingOptions
{

    private ProductRepository $repository;

    /**
     * @param \Src\Product\Domain\Contracts\ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $productId)
    {
        $id = new ProductId($productId);

        return $this->repository->getPricingOptions($id);

    }

}
