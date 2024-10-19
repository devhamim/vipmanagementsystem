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
        Schema::create('matchmakings', function (Blueprint $table) {
            $table->id();
            $table->string('groom_name');
            $table->string('groom_number')->nullable();
            $table->string('bride_name')->nullable();
            $table->string('bride_number')->nullable();
            $table->string('meeting_date')->nullable();
            $table->longText('progress_report')->nullable();
            $table->string('marrage_date')->nullable();
            $table->string('added_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matchmakings');
    }
};
