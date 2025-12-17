<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->string('payment_number')->unique(); // internal reference

            $table->decimal('amount', 10, 2)->default(0);
            $table->string('currency', 10)->default('USD');

            $table->enum('method', ['card', 'bank', 'paypal', 'stripe', 'cash', 'other'])
                ->default('other');

            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])
                ->default('pending');

            $table->string('provider')->nullable(); // stripe/paypal/etc
            $table->string('transaction_id')->nullable()->unique();

            $table->text('notes')->nullable();
            $table->json('meta')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
