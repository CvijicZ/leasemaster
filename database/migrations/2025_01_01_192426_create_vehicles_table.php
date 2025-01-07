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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('leased_by')->nullable()->default(null);
            $table->foreign('leased_by')
                ->references('id')
                ->on('users');
            $table->string('status')->default('garage');
            $table->string('make');
            $table->string('model');
            $table->string('engine');
            $table->float('miles');
            $table->string('color');
            $table->integer('seats');
            $table->string('transmission');
            $table->integer('year');
            $table->float('fuel_consumption');
            $table->float('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
