<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MemberTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function members_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns(
                'members',
                [
                    'id',
                    'name',
                    'membership_type',
                    'date_of_birth'
                ]
            ),
            1
        );
    }

}
