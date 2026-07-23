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
            $table->string('slug')->unique();
            $table->string('reference')->nullable();
            $table->json('title');            // translatable
            $table->json('description');       // translatable
            $table->longText('description_html')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->string('currency', 8)->default('EUR');
            $table->string('availability')->nullable();
            $table->string('brand')->nullable();
            $table->string('category')->default('e-roller')->index();
            $table->json('specifications')->nullable();
            $table->json('images')->nullable();
            $table->string('source_url')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
