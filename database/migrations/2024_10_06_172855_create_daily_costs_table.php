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
        Schema::create('daily_costs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('forwho')->nullable();
            $table->string('added_by')->nullable();
            $table->string('pay')->nullable();
            $table->string('due')->nullable();
            $table->string('total')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_costs');
    }
};
