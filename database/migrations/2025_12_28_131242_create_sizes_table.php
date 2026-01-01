<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique(); // Unique size code like S, M, L, XL
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Default sizes insert karein
        DB::table('sizes')->insert([
            ['name' => 'Extra Small', 'code' => 'XS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Small', 'code' => 'S', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Medium', 'code' => 'M', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Large', 'code' => 'L', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Extra Large', 'code' => 'XL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Double Extra Large', 'code' => 'XXL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Triple Extra Large', 'code' => 'XXXL', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Free Size', 'code' => 'FS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'One Size', 'code' => 'OS', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '28', 'code' => '28', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '30', 'code' => '30', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '32', 'code' => '32', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '34', 'code' => '34', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '36', 'code' => '36', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('sizes');
    }
};
