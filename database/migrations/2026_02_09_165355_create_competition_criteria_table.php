<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('competition_criteria', function (Blueprint $table) {
            $table->id();
            $table->foreignId('competition_id')
                ->constrained()
                ->cascadeOnDelete();
            $table->string('name');
            $table->unsignedTinyInteger('weight')->default(100);
            $table->unsignedTinyInteger('max_score')->default(10);

            $table->text('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('competition_criteria');
    }
};
