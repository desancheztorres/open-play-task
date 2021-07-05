<?php

namespace Tests\Feature;

use App\Models\MemberModel;
use App\Models\PricingModifierModel;
use App\Models\PricingOptionModel;
use App\Models\PricingOptionPricingModifierPivot;
use App\Models\ProductModel;
use App\Models\VenueModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Src\Product\Application\price\PriceCalculator;
use Tests\TestCase;

class PriceCalculatorTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
    }

    /** @test */
    public function members_under_25_has_discounts()
    {
        $pricingOption    = PricingOptionModel::factory()->create();
        $product          = ProductModel::factory()->create(['pricing_option_id' => $pricingOption->id]);
        $member           =
            MemberModel::factory()->create(['date_of_birth' => new \DateTime('2000-06-11')]);
        $venue            = VenueModel::factory()->create();
        $pricingModifiers = PricingModifierModel::factory()->create(
            [
                'type'     => 'member_age_multiplier',
                'settings' => json_decode('{"age_range": {"to": 25, "from": 0}, "multiplier": 0.75}')
            ]
        );
        PricingOptionPricingModifierPivot::factory()->create(
            ['pricing_modifier_id' => $pricingModifiers->id, 'pricing_option_id' => $pricingOption->id, 'active' => 1]
        );

        $getPrice = new PriceCalculator($product, $member, $venue);
        $price    = $getPrice->__invoke();

        $this->assertEquals($price, $product->pricingOption->price * $pricingModifiers->settings['multiplier']);
    }

    /** @test */
    public function glasgow_location_has_discounts()
    {
        $pricingOption    = PricingOptionModel::factory()->create();
        $product          = ProductModel::factory()->create(['pricing_option_id' => $pricingOption->id]);
        $member           =
            MemberModel::factory()->create();
        $venue            = VenueModel::factory()->create(['location' => 'Glasgow']);
        $pricingModifiers = PricingModifierModel::factory()->create(
            [
                'type'     => 'venue_override',
                'settings' => json_decode('{"price": 3, "venue_locations": ["Glasgow"]}')
            ]
        );
        PricingOptionPricingModifierPivot::factory()->create(
            ['pricing_modifier_id' => $pricingModifiers->id, 'pricing_option_id' => $pricingOption->id, 'active' => 1]
        );

        $getPrice = new PriceCalculator($product, $member, $venue);
        $price    = $getPrice->__invoke();

        $this->assertEquals($price, $pricingModifiers->settings['price']);
    }

    /** @test */
    public function platinum_members_has_a_big_discount()
    {
        $pricingOption    = PricingOptionModel::factory()->create();
        $product          = ProductModel::factory()->create(['pricing_option_id' => $pricingOption->id]);
        $member           =
            MemberModel::factory()->create(['membership_type' => 'platinum']);
        $venue            = VenueModel::factory()->create();
        $pricingModifiers = PricingModifierModel::factory()->create(
            [
                'type'     => 'membership_type_flat_adjustment',
                'settings' => json_decode('{"price": 0, "membership_types": ["platinum"]}')
            ]
        );
        PricingOptionPricingModifierPivot::factory()->create(
            ['pricing_modifier_id' => $pricingModifiers->id, 'pricing_option_id' => $pricingOption->id, 'active' => 1]
        );

        $getPrice = new PriceCalculator($product, $member, $venue);
        $price    = $getPrice->__invoke();

        $this->assertEquals($price, $pricingModifiers->settings['price']);
    }

}
