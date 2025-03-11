<?php

namespace Database\Seeders;

use App\Models\Account;
use App\Models\Transaction;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Clear the database
        DB::table('transactions')->delete();
        DB::table('users')->delete();
        DB::table('accounts')->delete();

        // Create account for Bob 
        $bobAccount = Account::factory()->create([
            'type' => 'checking',
            'status' => 'active',
            'balance' => 1000,
        ]);

        // Create Bob Alice
        User::factory()->create([
            'name' => 'Bob Alice',
            'email' => 'bob@example.com',
            'password' => 'password',
            'account_id' => $bobAccount->id,
        ]);

        $bobTransactions = Transaction::factory(10)->create([
            'account_id' => $bobAccount->id,
        ]);
        

        // Create 10 accounts
        $accounts = Account::factory(10)->create();
        
        // Create 10 users, each associated with one account
        $accounts->each(function ($account, $index) {
            $user = User::factory()->create([
                'account_id' => $account->id,
            ]);

            // Create 10 transactions for each user
            $transactions = Transaction::factory(10)->create([
                'account_id' => $account->id,
            ]);
            
            // For testing purposes, create one predefined user with the first account
            if ($index === 0) {
                User::factory()->create([
                    'name' => 'Test User',
                    'email' => 'test@test.com',
                    'account_id' => $account->id,
                ]);
            }
        });
    }
}
