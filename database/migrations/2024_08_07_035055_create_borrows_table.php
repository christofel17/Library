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
        Schema::create('borrows', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('volume_id');
            $table->foreignId('user_id');
            $table->string('status');
            $table->timestamp('borrow_date')->default(1111111111);
            $table->timestamp('return_date')->default(1111111111);
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
