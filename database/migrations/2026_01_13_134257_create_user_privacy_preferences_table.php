<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_privacy_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();

            $table->boolean('public_profile_visibility')->default(true);
            $table->boolean('show_activity_history')->default(true);
            $table->boolean('show_votes_publicly')->default(true);
            $table->boolean('allow_direct_messages')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_privacy_preferences');
    }
};
