<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AccountController extends Controller
{
    public function show(Request $request, string $id): JsonResponse
    {
        // Intentional SQL injection vulnerability using DB::connection()->getPdo() to execute raw SQL
        $pdo = DB::connection()->getPdo();
        $accountQuery = "SELECT * FROM accounts WHERE id = $id";
        $stmt = $pdo->query($accountQuery);
        $account = $stmt->fetch(\PDO::FETCH_ASSOC);
        
        $transactionQuery = "SELECT * FROM transactions WHERE account_id = $id";
        $stmt = $pdo->query($transactionQuery);
        $transactions = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        // The safe and laughably simple way I'm intentionally not using
        // $account = Account::find($id);
        
        return response()->json([
            'account' => $account,
            'transactions' => $transactions
        ]);
    }
}