<?php

declare(strict_types=1);

namespace Src\Product\Application\price;

use App\Models\MemberModel;
use App\Models\ProductModel;
use App\Models\VenueModel;
use App\PriceModifier\BasicAdjustment;
use App\PriceModifier\BasicMultiplier;
use App\PriceModifier\MemberAgeMultiplier;
use App\PriceModifier\MembershipAdjustment;
use App\PriceModifier\OverridePrice;
use App\PriceModifier\VenueOverride;
use Illuminate\Support\Arr;

class PriceCalculator
{

    private ProductModel $product;
    private MemberModel $member;
    private VenueModel $venue;

    protected $basePrice;
    protected array $prices;

    /**
     * PriceCalculator constructor.
     *
     * @param \App\Models\ProductModel $product
     * @param \App\Models\MemberModel  $member
     * @param \App\Models\VenueModel   $venue
     */
    public function __construct(ProductModel $product, MemberModel $member, VenueModel $venue)
    {
        $this->product = $product;
        $this->member  = $member;
        $this->venue   = $venue;
    }

    public function __invoke()
    {
        $pricingOptions            = $this->product->pricingOption;
        $availablePricingModifiers = $pricingOptions->currentPricingModifiers;
        $this->basePrice           = $pricingOptions->getPrice();

        if (! $availablePricingModifiers) {
            return $this->basePrice;
        } else {

            $this->prices = [$this->basePrice];

            foreach ($availablePricingModifiers as $modifier):

                switch ($modifier->getType()) {
                    case 'basic_override':
                        $overridePrice  = new OverridePrice($modifier->getSettings());
                        $this->prices[] = $overridePrice->modify();
                        break;
                    case 'basic_adjustment':
                        $basicAdjustment = new BasicAdjustment($modifier->getSettings(), $this->basePrice);
                        $this->prices[]  = $basicAdjustment->modify();
                        break;
                    case 'member_age_multiplier':
                        $memberAgeMultipplier =
                            new MemberAgeMultiplier($modifier->getSettings(), $this->basePrice, $this->member);
                        $this->prices[]       = $memberAgeMultipplier->modify();
                        break;
                    case 'venue_override':
                        $venueOverride  = new VenueOverride($modifier->getSettings(), $this->basePrice, $this->venue);
                        $this->prices[] = $venueOverride->modify();
                        break;
                    case 'membership_type_flat_adjustment':
                        $membershipAdjustment =
                            new MembershipAdjustment($modifier->getSettings(), $this->basePrice, $this->member);
                        $this->prices[]       = $membershipAdjustment->modify();
                        break;
                    case 'basic_multiplier':
                        $basicMultiplier = new BasicMultiplier($modifier->getSettings(), $this->basePrice);
                        $this->prices[]  = $basicMultiplier->modify();
                        break;
                }
            endforeach;
        }

        return $this->getLowerPrice() >= 0 ? $this->getLowerPrice() : 0;
    }

    protected function sortPrices(): array
    {
        return Arr::sort($this->prices);
    }

    protected function getLowerPrice()
    {
        return head($this->sortPrices());
    }

}
