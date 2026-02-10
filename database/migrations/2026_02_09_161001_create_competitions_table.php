<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();

            // Foreign key
            $table->foreignId('category_id')
                ->constrained('competition_categories')
                ->cascadeOnDelete();

            $table->text('short_description')->nullable();
            $table->string('cover_image')->nullable();

            // Submission Type
            $table->enum('submission_type', ['video', 'audio', 'image', 'text'])->default('video');

            // Video Duration
            $table->unsignedInteger('video_duration_limit')->nullable()->comment('in seconds');

            // Eligibility
            $table->enum('eligibility', [
                'all_verified_entertainers',
                'all_entertainers',
                'only_invited'
            ])->default('all_verified_entertainers');

            // Entry Fee
            $table->enum('entry_fee_type', ['free', 'paid'])->default('free');
            $table->decimal('entry_fee_amount', 10, 2)->default(0);

            // Dates
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->dateTime('voting_start_at')->nullable();
            $table->dateTime('voting_end_at')->nullable();

            // Judging
            $table->unsignedTinyInteger('judge_score_weight')->default(70);
            $table->unsignedTinyInteger('public_votes_weight')->default(30);
            $table->boolean('fraud_protection')->default(true);

            // Prize
            $table->string('prize_title');
            $table->decimal('prize_amount', 12, 2);
            $table->text('prize_description')->nullable();

            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('competitions');
    }
};
