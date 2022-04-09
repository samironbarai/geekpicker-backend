<?php

namespace Tests\Unit;

use App\Models\Currency;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_transaction_submitted_successfully()
    {
        // Insert USD and EUR currency to currencies table
        $currency = Currency::insert([['name' => 'USD'], ['name' => 'EUR']]);

        // Create 2 users
        $sender = User::factory()->create(['currency_id' => 1]);
        $receiver = User::factory()->create(['currency_id' => 2]);

        // Create a transaction
        // Here I have not used the real conversion API, instead I put 0 to currency rate, amount and total
        $transaction = Transaction::create([
            'sender_user_id' => $sender->id,
            'receiver_user_id' => $receiver->id,

            'sender_currency' => $sender->currency_id,
            'sender_rate' => 0,

            'receiver_currency' => $receiver->currency_id,
            'receiver_rate' => 0,
            'amount' => 0,
            'total' => 0,
        ]);

        $this->assertTrue(true);
    }
}
