<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('affiliate_referrals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('affiliate_id')->constrained()->cascadeOnDelete();

            // user who registered through link
            $table->foreignId('referred_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            // if referral is tied to a competition registration
            $table->foreignId('competition_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // link to payment (if your payments table exists)
            $table->foreignId('payment_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->decimal('base_amount', 10, 2)->default(0);
            $table->decimal('commission_amount', 10, 2)->default(0);

            $table->enum('status', ['pending', 'approved', 'rejected', 'refunded'])
                ->default('pending');

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_referrals');
    }
};
