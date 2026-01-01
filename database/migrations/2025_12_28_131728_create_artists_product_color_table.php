<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('artists_product_color', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artists_product_id')->constrained()->onDelete('cascade');
            $table->foreignId('color_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['artists_product_id', 'color_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('artists_product_color');
    }
};
