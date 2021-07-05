<?php

namespace Tests\Unit;

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
}
