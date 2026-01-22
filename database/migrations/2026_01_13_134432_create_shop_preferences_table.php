<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('shop_preferences', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->unique();

            $table->string('default_payment_method_id')->nullable(); // e.g. Stripe PM id
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shop_preferences');
    }
};
