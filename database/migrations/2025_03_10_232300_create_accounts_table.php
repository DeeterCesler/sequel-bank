<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('number');
            $table->string('type')->default('checking');
            $table->decimal('balance', 10, 2);
            $table->string('status')->default('active');
            $table->string('bitcoin_address')->nullable();
            $table->string('bitcoin')->nullable();
            $table->timestamps();
        });

        // update users table to add account_id
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('account_id')->nullable()->constrained('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['account_id']);
            $table->dropColumn('account_id');
        });
        Schema::dropIfExists('accounts');
    }
};
