<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class VenueTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function venues_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'venues',
                [
                    'id',
                    'name',
                    'location'
                ]
            ),
            1
        );
    }
}
