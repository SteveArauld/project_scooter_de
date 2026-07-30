<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            /*
             | Streichpreis (regulärer Preis vor der Aktion). Nur gesetzt, wenn
             | der Artikel tatsächlich reduziert ist – dann gilt:
             |   price      = aktueller Aktionspreis  -> g:sale_price
             |   list_price = regulärer Preis         -> g:price
             |
             | NULL bedeutet: keine Aktion, es wird nur ein Preis angezeigt und
             | exportiert. Ein Streichpreis darf ausschließlich einen Preis
             | abbilden, der zuvor wirklich verlangt wurde (§ 11 PAngV).
             */
            $table->decimal('list_price', 10, 2)->nullable()->after('price');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('list_price');
        });
    }
};
