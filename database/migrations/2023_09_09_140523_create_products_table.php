<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title', 200);
            $table->string('shortDescription', 500);
            $table->string('price', 50);
            $table->boolean('discount');
            $table->string('discountPrice', 50);
            $table->string('img', 300);
            $table->boolean('stock');
            $table->float('ratingStar');
            $table->enum('remark', ['new', 'regular', 'top', 'popular', 'trending', 'spacial']);

            // Foreign-key
            $table->unsignedBigInteger('categoryId');
            $table->unsignedBigInteger('brandId');


            //Category Relationship
            $table->foreign('categoryId')
                ->references('id')->on('categories')
                ->restrictOnDelete()
                ->cascadeOnUpdate();


            //Brand Relationship
            $table->foreign('brandId')
                ->references('id')->on('brands')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};