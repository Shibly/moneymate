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
        Schema::table('incomes', function (Blueprint $table) {
            $table->string('reference', 250)->nullable()->after('amount');
            $table->date('income_date')->after('reference')->nullable();
            $table->mediumText('note')->after('income_date')->nullable();
            $table->mediumText('attachment')->after('note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('incomes', function (Blueprint $table) {
            //
        });
    }
};
