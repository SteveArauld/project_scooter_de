<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Untergruppe: neu | zubehoer | akku | ersatzteile | tuning
            $table->string('subcategory')->default('neu')->index()->after('category');
            // Aktionsartikel (aus der Quell-Kategorie "Sale")
            $table->boolean('on_sale')->default(false)->index()->after('subcategory');
            // Original-Kategorien der Quelle (zur Nachvollziehbarkeit)
            $table->json('raw_categories')->nullable()->after('on_sale');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['subcategory', 'on_sale', 'raw_categories']);
        });
    }
};
