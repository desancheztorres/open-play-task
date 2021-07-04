<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Src\Member\Infrastructure\GetAllMembersController;
use Src\Product\Infrastructure\GetAllProductsController;
use Src\Venue\Infrastructure\GetAllVenuesController;

class PriceCalculatorViewController extends Controller
{

    private GetAllProductsController $getAllProductsController;
    private GetAllMembersController $getAllMembersController;
    private GetAllVenuesController $getAllVenuesController;

    /**
     * PriceCalculatorViewController constructor.
     *
     * @param \Src\Product\Infrastructure\GetAllProductsController $getAllProductsController
     * @param \Src\Member\Infrastructure\GetAllMembersController   $getAllMembersController
     * @param \Src\Venue\Infrastructure\GetAllVenuesController     $getAllVenuesController
     */
    public function __construct(
        GetAllProductsController $getAllProductsController,
        GetAllMembersController $getAllMembersController,
        GetAllVenuesController $getAllVenuesController

    ) {
        $this->getAllProductsController = $getAllProductsController;
        $this->getAllMembersController  = $getAllMembersController;
        $this->getAllVenuesController   = $getAllVenuesController;

    }

    public function __invoke(): View
    {
        $members  = $this->getAllMembersController->__invoke();
        $venues   = $this->getAllVenuesController->__invoke();
        $products = $this->getAllProductsController->__invoke();

        return view('prices.index', compact('members', 'venues', 'products'));
    }

}
