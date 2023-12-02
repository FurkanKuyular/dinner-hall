<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_user_can_pass_on_the_gate(): void
    {
        $this->artisan('optimize:clear');

        $response = $this->post('api/gates', $this->getCorrectPayload());

        $response->assertNoContent();
    }

    public function test_user_cant_pass_on_the_gate(): void
    {
        foreach (range(1, 2) as $attempt) {
            $response = $this->post('api/gates', $this->getCorrectPayload());

            $response->assertNoContent();
        }

        $response = $this->post('api/gates', $this->getCorrectPayload());

        $response->assertTooManyRequests();
    }

    public function test_user_get_unprocessable_entity()
    {
        $response = $this->post('api/gates', $this->getUnCorrectPayload());
        
        $response->assertUnprocessable();
    }

    private function getCorrectPayload(): array
    {
        return [
            'price' => '55.33',
            'point' => '0.00',
            'order_id' => '3307333742',
            'user_id' => '3b43544b-10b4-45e2-ab81-2b2b3f1917e8',
            'ref_code' => '0781534070',
            'callback_success_url' => 'https://case.altpay.dev/success',
            'callback_fail_url' => 'https://case.altpay.dev/fail',
            'hash' => '2918f946ce80bd37e7dbf4ade4888df9d281de0d',
        ];
    }

    private function getUnCorrectPayload(): array
    {
        return [
            'price' => '55.33',
            'point' => '0.00',
            'order_id' => '330733374',
            'user_id' => '3b43544b-10b4-45e2-ab81-2b2b3f1917e',
            'ref_code' => '078153407',
            'callback_success_url' => 'https://case.altpay.dev/success',
            'callback_fail_url' => 'https://case.altpay.dev/fail',
            'hash' => '5918f946ce80bd37e3dbf4ade4888df9d281de01',
        ];
    }
}
