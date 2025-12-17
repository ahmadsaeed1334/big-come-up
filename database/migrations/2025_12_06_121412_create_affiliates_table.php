<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->unique()->constrained()->cascadeOnDelete();

            $table->string('code')->unique(); // referral code
            $table->boolean('is_active')->default(true);

            // tracking counters
            $table->unsignedInteger('clicks')->default(0);
            $table->unsignedInteger('signups')->default(0);
            $table->unsignedInteger('paid_registrations')->default(0);

            // commission %
            $table->decimal('commission_rate', 5, 2)->default(30.00);

            $table->text('notes')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
