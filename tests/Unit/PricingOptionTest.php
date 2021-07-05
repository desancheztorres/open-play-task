<?php

namespace Tests\Unit;

use App\Models\PricingModifierModel;
use App\Models\PricingOptionModel;
use App\Models\ProductModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PricingOptionTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /** @test */
    public function pricing_options_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'pricing_options',
                [
                    'id',
                    'name',
                    'type',
                    'price'
                ]
            ),
            1
        );
    }

    /** @test */
    public function a_pricing_option_has_many_products()
    {
        $pricingOption = PricingOptionModel::factory()->create();
        $product       = ProductModel::factory()->create(['pricing_option_id' => $pricingOption->id]);

        // A product exists in a pricing option collections.
        $this->assertTrue($pricingOption->products->contains($product));

        // Count that a pricing options collection exists.
        $this->assertEquals(1, $pricingOption->products->count());

        // Products are related to Pricing options and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $pricingOption->products);
    }

    /** @test  */
    public function a_pricing_option_belongs_to_many_pricing_modifiers()
    {
        $pricingOption = PricingOptionModel::factory()->create();
        $pricingModifier = PricingModifierModel::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $pricingOption->pricingModifiers);
    }

}
