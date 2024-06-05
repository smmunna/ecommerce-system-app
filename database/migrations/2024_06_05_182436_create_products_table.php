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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->text('summary')->nullable();
            $table->longText('description')->nullable();
            $table->string('photo')->nullable();
            $table->integer('stock')->nullable();
            $table->string('size')->nullable();
            $table->string('condition')->nullable();
            $table->boolean('status')->default(false)->nullable();
            $table->decimal('price', 8, 2)->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->boolean('is_featured')->default(false)->nullable();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->timestamps();
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
