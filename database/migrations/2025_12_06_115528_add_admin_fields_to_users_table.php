<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Snapshot/quick filter role (Spatie remains source of truth)
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->nullable()->after('password');
            }

            // Business identity integer
            if (!Schema::hasColumn('users', 'user_type')) {
                $table->unsignedTinyInteger('user_type')->default(5)->after('role'); // 5=Fan
            }

            // Suspend/activate
            if (!Schema::hasColumn('users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('user_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'role')) $table->dropColumn('role');
            if (Schema::hasColumn('users', 'user_type')) $table->dropColumn('user_type');
            if (Schema::hasColumn('users', 'is_active')) $table->dropColumn('is_active');
        });
    }
};
