<?php

declare(strict_types=1);

namespace Src\Product\Infrastructure;

use Illuminate\Database\Eloquent\Collection;
use Src\Product\Application\get\GetAllProducts;
use Src\Product\Infrastructure\Repositories\EloquentProductRepository;

final class GetAllProductsController
{

    private EloquentProductRepository $repository;

    /**
     * GetAllProductsController constructor.
     *
     * @param \Src\Product\Infrastructure\Repositories\EloquentProductRepository $repository
     */
    public function __construct(EloquentProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        $getAllProducts = new GetAllProducts($this->repository);

        return $getAllProducts->__invoke();
    }

}
