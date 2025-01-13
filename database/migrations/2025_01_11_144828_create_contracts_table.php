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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreignId('vehicle_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();
            $table->integer('contract_months');
            $table->integer('annual_miles');
            $table->float('initial_payment', 2);
            $table->float('total_price', 2);
            $table->float('price_per_month', 2);
            $table->date('valid_until');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
