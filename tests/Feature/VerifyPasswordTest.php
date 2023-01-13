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
    /**
     * Tests if the types returned are as expected.
     * 
     * @return void
     */
    public function testTypesDataAreAsExpected()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'Test_1234*'
        ]);
        $response->assertOk();

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
     * Tests if the min size validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinSizeValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'Test'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minSize', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }

    /**
     * Tests if the min special chars validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinSpecialCharsValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'Test'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minSpecialChars', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }

    /**
     * Tests if the no repeted validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testNoRepetedValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'TTest'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('noRepeted', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }

    /**
     * Tests if the min numeric digits validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinDigitValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'TTest'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minDigit', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }

    /**
     * Tests if the min uppercase digits validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinUppercaseValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'test'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minUppercase', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }

    /**
     * Tests if the min lowercase digits validation works correctly
     * and verify is false, status code must be 400.
     *
     * @return void
     */
    public function testMinLowercaseValidationWorks()
    {
        $response = $this->post(self::VERIFY_ROUTE, [
            'password' => 'TEST'
        ]);

        $response->assertStatus(Response::HTTP_BAD_REQUEST);
        $this->assertContains('minLowercase', $response->json()['match']);
        $this->assertFalse($response->json()['verify']);
    }
}
