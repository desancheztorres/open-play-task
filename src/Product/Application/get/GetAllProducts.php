<?php

declare(strict_types=1);

namespace Src\Product\Application\get;

use Illuminate\Database\Eloquent\Collection;
use Src\Product\Domain\Contracts\ProductRepository;

final class GetAllProducts
{

    private ProductRepository $repository;

    /**
     * GetAllProducts constructor.
     *
     * @param \Src\Product\Domain\Contracts\ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|null
     */
    public function __invoke(): ?Collection
    {
        return $this->repository->all();
    }

}
