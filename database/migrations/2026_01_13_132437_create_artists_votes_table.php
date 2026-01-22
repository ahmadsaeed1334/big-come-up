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
        Schema::create('artists_votes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('performance_id');

            $table->timestamps();

            // prevent duplicate votes
            $table->unique(['user_id', 'performance_id']);

            // custom foreign key names (IMPORTANT)
            $table->foreign('user_id', 'artists_votes_user_fk')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('performance_id', 'artists_votes_performance_fk')
                ->references('id')
                ->on('performances')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artists_votes');
    }
};
