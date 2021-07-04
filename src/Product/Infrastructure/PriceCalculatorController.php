<?php

declare(strict_types=1);

namespace Src\Product\Infrastructure;

use App\Http\Requests\PriceCalculatorRequest;
use Src\Member\Application\get\GetMember;
use Src\Member\Infrastructure\Repositories\EloquentMemberRepository;
use Src\Product\Application\get\GetProduct;
use Src\Product\Application\price\PriceCalculator;
use Src\Product\Infrastructure\Repositories\EloquentProductRepository;
use Src\Venue\Application\get\GetVenue;
use Src\Venue\Infrastructure\Repositories\EloquentVenueRepository;

final class PriceCalculatorController
{

    private EloquentProductRepository $productRepository;
    private EloquentMemberRepository $memberRepository;
    private EloquentVenueRepository $venueRepository;

    public function __construct(
        EloquentProductRepository $eloquentProductRepository,
        EloquentMemberRepository $eloquentMemberRepository,
        EloquentVenueRepository $eloquentVenueRepository
    ) {
        $this->productRepository = $eloquentProductRepository;
        $this->memberRepository  = $eloquentMemberRepository;
        $this->venueRepository   = $eloquentVenueRepository;
    }

    public function __invoke(PriceCalculatorRequest $request)
    {
        $productId = (int) $request->product;
        $memberId  = (int) $request->member;
        $venueId   = (int) $request->venue;

        $request->session()->put(['product' => $productId, 'venue' => $venueId, 'member' => $memberId]);

        $getProduct = new GetProduct($this->productRepository);
        $product    = $getProduct->__invoke($productId);

        $getMember = new GetMember($this->memberRepository);
        $member    = $getMember->__invoke($memberId);

        $getVenue = new GetVenue($this->venueRepository);
        $venue    = $getVenue->__invoke($venueId);

        $getPrice = new PriceCalculator($product, $member, $venue);
        $price    = $getPrice->__invoke();

        $request->session()->put('lowerPrice', $price);

        return $price;

    }

}
