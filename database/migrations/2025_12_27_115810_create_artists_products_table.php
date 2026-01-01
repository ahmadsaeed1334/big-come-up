<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('artists_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artists_category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('artist_id')->nullable()->constrained()->nullOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->decimal('price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();

            $table->float('rating')->default(0);
            $table->integer('reviews_count')->default(0);

            $table->text('description')->nullable();
            $table->text('product_details')->nullable();

            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // child tables FIRST
        Schema::disableForeignKeyConstraints();

        Schema::dropIfExists('product_reviews');
        Schema::dropIfExists('product_sizes');
        Schema::dropIfExists('product_colors');
        Schema::dropIfExists('product_images');

        // spatie media table
        Schema::dropIfExists('media');

        // parent table LAST
        Schema::dropIfExists('artists_products');

        Schema::enableForeignKeyConstraints();
    }
};
