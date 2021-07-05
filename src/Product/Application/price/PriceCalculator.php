<?php

declare(strict_types=1);

namespace Src\Product\Application\price;

use App\Models\MemberModel;
use App\Models\ProductModel;
use App\Models\VenueModel;

class PriceCalculator
{

    protected ProductModel $product;
    protected MemberModel $member;
    protected VenueModel $venue;
    protected $thePrice;

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
        $this->thePrice            = $pricingOptions->getPrice();

        if (! $availablePricingModifiers) {
            return $pricingOptions->getPrice();
        } else {
            $this->thePrice = $pricingOptions->getPrice();

            $thePrices = [$pricingOptions->getPrice()];

            foreach ($availablePricingModifiers as $modifier):

                switch ($modifier->getType()) {
                    case 'basic_override':
                        $resp = $this->overridePrice($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                    case 'basic_adjustment':
                        $resp = $this->basicAdjustment($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                    case 'member_age_multiplier':
                        $resp = $this->ageMultiplier($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                    case 'venue_override':
                        $resp = $this->venueOverride($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                    case 'membership_type_flat_adjustment':
                        $resp = $this->membershipAdjustment($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                    case 'basic_multiplier':
                        $resp = $this->basicMultiplier($modifier->getSettings());
                        if ($resp) {
                            $thePrices[] = $resp;
                        }
                        break;
                }
            endforeach;

            sort($thePrices);

            $lowerPrice = $thePrices[0];
        }

        return $lowerPrice >= 0 ? $lowerPrice : 0;
    }

    protected function overridePrice(array $data)
    {
        return $data['price'];
    }

    protected function basicAdjustment(array $data)
    {
        return $this->thePrice + $data['adjustment'];
    }

    protected function ageMultiplier(array $data)
    {
        if ($this->member->getMyAge() > $data['age_range']['from'] and
            $this->member->getMyAge() < $data['age_range']['to']) {
            return $this->thePrice * $data['multiplier'];
        }
    }

    protected function venueOverride(array $data)
    {
        if ((in_array($this->venue->getLocation(), $data['venue_locations']))) {
            if (array_key_exists('multiplier', $data)) {
                return $this->thePrice * $data['multiplier'];
            };

            if (array_key_exists('price', $data)) {
                return $data['price'];
            };
        }
    }

    protected function membershipAdjustment(array $data)
    {
        if (in_array($this->member->getMembershipType(), $data['membership_types'])) {
            if (array_key_exists('adjustment', $data)) {
                return $this->thePrice + $data['adjustment'];
            };

            if (array_key_exists('price', $data) and $this->member->membership_type === 'platinum') {
                return -1;
            };
        }
    }

    protected function basicMultiplier(array $data)
    {
        return $this->thePrice * $data['multiplier'];
    }

}
