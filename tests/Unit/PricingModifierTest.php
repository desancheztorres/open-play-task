<?php

namespace Tests\Unit;

use App\Models\PricingModifierModel;
use App\Models\PricingOptionModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PricingModifierTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pricing_options_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'pricing_modifiers',
                [
                    'id',
                    'type',
                    'settings'
                ]
            ),
            1
        );
    }

    /** @test  */
    public function a_pricing_modifier_belongs_to_many_pricing_options()
    {
        $pricingModifier = PricingModifierModel::factory()->create();
        $pricingOption = PricingOptionModel::factory()->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $pricingModifier->pricingOptions);
    }
}
