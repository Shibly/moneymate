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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('bank_name_id')->constrained('bank_names')->onDelete('cascade')->onUpdate('cascade');
            $table->bigInteger('currency_id')->nullable();
            $table->string('account_name');
            $table->string('account_number');
            $table->decimal('balance', 65, 2);
            $table->decimal('usd_balance', 65, 5);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
        Schema::dropColumn('bank_name');
    }
};
