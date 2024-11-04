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
            $table->id(); // Auto-incrementing ID
            $table->string('product_name'); // Name of the product
            $table->integer('quantity'); // Quantity available
            $table->decimal('price', 10, 2); // Price of the product
            $table->string('condition'); // Condition of the product (e.g., New, Used)
            $table->text('description')->nullable(); // Optional description of the product
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Drop the products table
    }
};
