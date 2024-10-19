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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('user_id')->nullable();
            $table->string('image')->nullable();
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('salary');
            $table->string('havetopay')->nullable();
            $table->string('status')->default(1);
            $table->string('commission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
