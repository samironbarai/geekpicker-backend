<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Repositories\TransactionRepository;

class TransactionController extends Controller
{
    public function store(StoreTransactionRequest $request, TransactionRepository $transactionRepository)
    {
        try {
            $transactionRepository->create($request);
            return response()->json(['status' => 'success', 'message' => 'Transaction successful']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Transaction failed: ' . $e->getMessage()]);
        }
    }
}
