<?php

namespace Tests\Unit;

use App\Models\PricingOptionModel;
use App\Models\ProductModel;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class ProductTest extends TestCase
{

    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function products_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'products',
                [
                    'id',
                    'name',
                    'type',
                    'description',
                    'pricing_option_id'
                ]
            ),
            1
        );
    }

    /** @test */
    public function a_product_belongs_to_a_pricing_option()
    {
        $pricingOption = PricingOptionModel::factory()->create();
        $product       = ProductModel::factory()->create(['pricing_option_id' => $pricingOption->id]);

        // Test by count that a product has a parent relationship with pricing option
        $this->assertEquals(1, $product->pricingOption->count());

        $this->assertInstanceOf(PricingOptionModel::class, $product->pricingOption);
    }

}
