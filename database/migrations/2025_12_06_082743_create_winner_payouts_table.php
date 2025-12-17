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
        Schema::create('winner_payouts', function (Blueprint $table) {
            $table->id();

            $table->foreignId('competition_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // winner
            $table->foreignId('entry_id')->nullable()->constrained()->nullOnDelete();

            $table->decimal('amount', 10, 2)->default(0);
            $table->enum('type', ['dj', 'artist', 'affiliate'])->default('artist');
            $table->enum('status', ['pending', 'paid'])->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('winner_payouts');
    }
};
