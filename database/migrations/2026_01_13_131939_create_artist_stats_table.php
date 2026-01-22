<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artist_stats', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique(); // 1-1

            $table->unsignedInteger('artists_followed_count')->default(0);
            $table->unsignedInteger('competitions_count')->default(0);
            $table->unsignedInteger('liked_stories_count')->default(0);
            $table->unsignedInteger('followers_count')->default(0);
            $table->unsignedInteger('wins_count')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_stats');
    }
};
