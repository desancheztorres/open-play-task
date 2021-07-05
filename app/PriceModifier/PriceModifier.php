<?php

namespace App\PriceModifier;

abstract class PriceModifier
{

    protected array $data;
    protected mixed $basePrice;
    protected $model;

    /**
     * PriceModifier constructor.
     *
     * @param array                                    $data
     * @param null                                     $basePrice
     * @param null $model
     */
    public function __construct(array $data, $basePrice = null, $model = null)
    {
        $this->data      = $data;
        $this->basePrice = $basePrice;
        $this->model     = $model;

    }

    abstract public function modify();

}
