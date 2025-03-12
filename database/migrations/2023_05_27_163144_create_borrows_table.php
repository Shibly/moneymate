<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('amount', 65, 2);
            $table->decimal('exchange_amount', 65, 2)->default(0.00);
            $table->decimal('usd_amount', 65, 5)->default(0.00);
            $table->date('date')->nullable();
            $table->foreignId('debt_id')->constrained('debts')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('currency_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrows');
    }
};
