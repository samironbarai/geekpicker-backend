<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function mostConversion()
    {
        $transaction = Transaction::select('sender_user_id', DB::raw('sum(total) as amount'), DB::raw('count(*) as total'))
            ->groupBy('sender_user_id')
            ->orderBy('amount', 'DESC')
            ->first();

        return response()->json(['name' => $transaction->user->name, 'amount' => $transaction->amount, 'total' => $transaction->total]);
    }

    public function allUsersConversion()
    {
        $transactions = Transaction::with(['user' => function ($query) {
            $query->select('id', 'name');
        }])
            ->select('transactions.id', 'sender_user_id', DB::raw('sum(total) as amount'))
            ->groupBy('sender_user_id')
            ->get();

        return response()->json($transactions);
    }

    public function thirdHighestConversion($userId)
    {
        $sub = Transaction::where('sender_user_id', $userId)->orderBy('total', 'DESC')->limit(3);
        $result = DB::table(DB::raw("({$sub->toSql()}) as sub"))
            ->mergeBindings($sub->getQuery())
            ->orderBy('total')->first();

        return response()->json($result);
    }
}
