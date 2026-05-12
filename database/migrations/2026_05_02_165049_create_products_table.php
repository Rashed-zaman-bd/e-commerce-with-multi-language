<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->foreignId('brand_id')
                  ->nullable()
                  ->constrained('brands')
                  ->nullOnDelete();

            $table->foreignId('category_id') 
                  ->nullable()
                  ->constrained('categories')
                  ->nullOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->integer('price');
            $table->integer('previous_price')->nullable();
            $table->integer('discount_percent')->nullable();

            $table->boolean('trending')->default(false);
            $table->boolean('free_delivery')->default(false);
            $table->boolean('emi')->default(false);
            $table->boolean('exchange')->default(false); 

            $table->string('weight')->nullable();
            $table->string('unit')->nullable();

            $table->integer('stock')->default(0);

            $table->string('image')->nullable();
            $table->text('description')->nullable(); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};