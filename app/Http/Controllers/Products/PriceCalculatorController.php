<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceCalculatorRequest;

class PriceCalculatorController extends Controller
{
    protected \Src\Product\Infrastructure\PriceCalculatorController $priceCalculatorController;

    /**
     * PriceCalculatorController constructor.
     *
     * @param \Src\Product\Infrastructure\PriceCalculatorController $priceCalculatorController
     */
    public function __construct(\Src\Product\Infrastructure\PriceCalculatorController $priceCalculatorController)
    {
        $this->priceCalculatorController = $priceCalculatorController;
    }

    /**
     * @param \App\Http\Requests\PriceCalculatorRequest $request
     */
    public function __invoke(PriceCalculatorRequest $request)
    {
        $this->priceCalculatorController->__invoke($request);

        return redirect('/');
    }

}
