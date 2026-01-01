<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('colors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable(); // HEX color code
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Default colors insert karein
        DB::table('colors')->insert([
            ['name' => 'Red', 'code' => '#FF0000', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Blue', 'code' => '#0000FF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Green', 'code' => '#008000', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Black', 'code' => '#000000', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'White', 'code' => '#FFFFFF', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Yellow', 'code' => '#FFFF00', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Orange', 'code' => '#FFA500', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Purple', 'code' => '#800080', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pink', 'code' => '#FFC0CB', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brown', 'code' => '#A52A2A', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gray', 'code' => '#808080', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Silver', 'code' => '#C0C0C0', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gold', 'code' => '#FFD700', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('colors');
    }
};
