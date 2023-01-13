<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Http\Response;
use Tests\TestCase;

class VerifyPasswordTest extends TestCase
{
    const VERIFY_ROUTE = 'api/verify';

    /**
     * Tests if the received json structure is as expected.
     *
     * @return void
     */
    public function testJsonStructure()
    {
        $response = $this->post(self::VERIFY_ROUTE);
        $response->assertOk();

        $response->assertJsonStructure([
            'password',
            'verify',
            'match',
            'rules' => [
                [
                    'rule',
                    'value'
                ]
                
            ],
        ]);
    }

}
