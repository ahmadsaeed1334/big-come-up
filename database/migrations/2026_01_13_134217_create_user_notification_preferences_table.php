<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_notification_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();

            $table->boolean('email_competition_updates')->default(true);
            $table->boolean('email_voting_reminders')->default(true);
            $table->boolean('email_sweepstakes_results')->default(true);
            $table->boolean('email_radio_show_alerts')->default(true);
            $table->boolean('email_platform_announcements')->default(true);

            $table->boolean('push_live_competitions')->default(true);
            $table->boolean('push_new_performances')->default(true);
            $table->boolean('push_winner_announcements')->default(true);
            $table->boolean('push_community_activity')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_notification_preferences');
    }
};
