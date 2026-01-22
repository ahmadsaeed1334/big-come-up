<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artist_profiles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->unique(); // 1-1

            $table->text('bio')->nullable();

            $table->string('location_city')->nullable();
            $table->string('location_country')->nullable();

            $table->string('avatar_path')->nullable();
            $table->string('banner_path')->nullable();

            $table->json('social_links')->nullable();

            $table->boolean('is_public')->default(true);
            $table->boolean('allow_messages')->default(true);

            $table->timestamps();

            $table->index(['is_public']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_profiles');
    }
};
