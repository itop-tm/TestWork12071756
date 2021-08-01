<?php

namespace Tests\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\BankCard;

class BankCardsTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Authorization' => "Bearer {$this->userToken}",
        ]);
    }

    public function test_user_can_create_bank_card_test()
    {
        $response = $this->postJson('cards', [
            'issuer'          => 'ABN AMRO Bank',
            'cardholder_name' => 'Hojayev Mohamed',
            'number'          => '31407983520',
            'expires_at'      => '2036-04',
        ]);

        $response->dump();

        $response
            ->assertStatus(202)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_user_can_get_cards_test()
    {
        $response = $this->json('GET', 'cards');

        $response->dump();

        $response
            ->assertStatus(200);
    }

    public function test_user_can_get_card_by_id_test()
    {
        $response = $this->json('GET', 'cards/1');

        $response->dump();

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_user_can_update_card_test()
    {
        $response = $this->putJson('cards/2', [
            'issuer'          => 'ABN AMRO Bank',
            'cardholder_name' => 'Hojayev Mohamed',
            'number'          => '31407983520',
            'expires_at'      => '2036-04',
        ]);

        $response->dump();

        $response
            ->assertStatus(202)
            ->assertJson([
                'success' => true,
            ]);
    }

    public function test_user_can_delete_card_test()
    {
        $response = $this->deleteJson('cards/2');

        $response->dump();

        $response
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
            ]);
    }
}
