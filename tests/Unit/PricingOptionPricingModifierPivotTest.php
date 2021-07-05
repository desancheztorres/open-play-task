<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PricingOptionPricingModifierPivotTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function pricing_options_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'pricing_option_pricing_modifiers',
                [
                    'pricing_modifier_id',
                    'pricing_option_id',
                    'valid_from',
                    'valid_to',
                    'active'
                ]
            ),
            1
        );
    }

}
