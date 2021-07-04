<?php

namespace App\Http\Controllers;


use App\Http\Requests\PriceCalculatorRequest;
use App\Models\MemberModel;
use App\Models\ProductModel;
use App\Models\VenueModel;
use App\Price\CalculatePrice;

class PriceController extends Controller
{
    public function __invoke(PriceCalculatorRequest $request)
    {
        $productId = (int) $request->product;

        $product = ProductModel::findOrFail($productId);
        $venue   = VenueModel::findOrFail($request->venue);
        $member  = MemberModel::findOrFail($request->member);

        $request->session()->put(['product' => $product->id, 'venue' => $venue->id, 'member' => $member->id]);

        $price      = new CalculatePrice($product, $venue, $member);
        $lowerPrice = $price->__invoke();

        $request->session()->put('lowerPrice', $lowerPrice);

        return redirect('/');

    }

}
