<?php

namespace Tests\Feature;

use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Http\Response;
use Tests\TestCase;

class VerifyPasswordTest extends TestCase
{
    /**
     * Const with endpoint of api
     */
    const VERIFY_ROUTE = 'api/verify';

    /**
     * Const with password that fails all validations
     */
    const BASIC_PASSWORD = '113-';

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
    /**
     * Tests if the types returned are as expected.
     * 
     * @return void
     */
    public function testTypesDataAreAsExpected()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => self::BASIC_PASSWORD
        ]);

        $response->assertJson(
            fn (AssertableJson $json) => $json->whereAllType([
                'password' => 'string',
                'rules' => 'array',
                'rules.0.rule' => 'string',
                'rules.0.value' => 'integer',
                'verify' => 'boolean',
                'match' => 'array'
            ])
        );
    }

    /**
     * Tests if the all validations works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinSizeValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => self::BASIC_PASSWORD
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minSize', $response->json()['match']);
        $this->assertContains('minSpecialChars', $response->json()['match']);
        $this->assertContains('noRepeted', $response->json()['match']);
        $this->assertContains('minDigit', $response->json()['match']);
        $this->assertContains('minUppercase', $response->json()['match']);
        $this->assertContains('minLowercase', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }
}
