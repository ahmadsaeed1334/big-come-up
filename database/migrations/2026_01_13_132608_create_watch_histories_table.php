<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('watch_histories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('performance_id');

            $table->timestamps();

            $table->index('user_id');
            $table->index('performance_id');

            // custom foreign key names (IMPORTANT)
            $table->foreign('user_id', 'watch_histories_user_fk')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();

            $table->foreign('performance_id', 'watch_histories_performance_fk')
                ->references('id')
                ->on('performances')
                ->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('watch_histories');
    }
};
