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
        Schema::create('data_entries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('number')->nullable();
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('position')->nullable();
            $table->string('required')->nullable();
            $table->string('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('added_by')->nullable();
            $table->string('lead')->nullable();
            $table->string('status')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_entries');
    }
};
