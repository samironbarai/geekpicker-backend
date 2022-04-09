<?php

namespace App\Repositories;

use App\Events\TransactionProcessed;
use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\CurrencyConversion;

class TransactionRepository
{
    public function create(Request $request)
    {
        // Getting sender and receiver users info
        $senderAndReceiverUsersInfo = $this->_getSenderAndReceiverInfo($request->sender_user_id, $request->receiver_user_id);

        // Calculating amount after conversion
        $total = $this->_calculateTotalAfterConversion($senderAndReceiverUsersInfo['sender']['rate'], $senderAndReceiverUsersInfo['receiver']['rate'], $request->amount);

        $transaction = new Transaction();
        $transaction->sender_user_id = $request->sender_user_id;
        $transaction->receiver_user_id = $request->receiver_user_id;
        $transaction->sender_rate = $senderAndReceiverUsersInfo['sender']['rate'];
        $transaction->receiver_rate = $senderAndReceiverUsersInfo['receiver']['rate'];
        $transaction->sender_currency = $senderAndReceiverUsersInfo['sender']['currency'];
        $transaction->receiver_currency = $senderAndReceiverUsersInfo['receiver']['currency'];
        $transaction->amount = $request->amount;
        $transaction->total = $total;
        $transaction->save();

        // Send notification after successful transaction
        TransactionProcessed::dispatch($transaction);
    }

    protected function _getSenderAndReceiverInfo($senderUserId, $receiverUserId)
    {
        // Getting sender and receivers
        $users = User::whereIn('id', [$senderUserId, $receiverUserId])
            ->get();

        // Getting currency conversion instance
        $currencyConversion = new CurrencyConversion();

        // Creating new array, and adding currency, rate for sender and receiver
        $results = [];
        foreach ($users as $user) {
            if ($user->id == $senderUserId) {
                $results['sender']['currency'] = $user->currency->name;
                $results['sender']['rate'] = $currencyConversion->getRate($user->currency->name);
            } else {
                $results['receiver']['currency'] = $user->currency->name;
                $results['receiver']['rate'] = $currencyConversion->getRate($user->currency->name);
            }
        }

        return $results;
    }

    protected function _calculateTotalAfterConversion($senderRate, $receiverRate, $amount)
    {
        // Converting sender amount into Base currency amount (EUR)
        $eur = $amount / $senderRate;

        // Converting eur amount into receiver currency
        return $eur * $receiverRate;
    }
}
