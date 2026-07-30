<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Trägt den Streichpreis für die drei Artikel nach, die im Shop bereits mit
 * einem Rabatt-Badge beworben wurden, im Merchant-Feed aber ohne g:sale_price
 * ausgeliefert wurden (Beanstandung Google Merchant Center).
 *
 * ACHTUNG – bitte fachlich gegenprüfen: Die Streichpreise stammen aus der
 * bisherigen Anzeige auf der Startseite, die den "Originalpreis" rechnerisch
 * aus einem pauschalen 15-%-Badge abgeleitet hat (price / 0,85). Sie sind
 * damit nicht belegt als Preise, die tatsächlich einmal verlangt wurden.
 * Nach § 11 PAngV darf als Streichpreis nur der niedrigste Preis der letzten
 * 30 Tage ausgewiesen werden. Falls diese Beträge nie gefordert wurden, sind
 * die Werte hier durch die echten früheren Preise zu ersetzen – oder auf NULL
 * zu setzen, dann entfällt Badge und Streichpreis vollständig.
 */
return new class extends Migration
{
    /** Titel-Fragmente (alle müssen vorkommen), bisheriger Preis, Streichpreis. */
    private const DEALS = [
        [['KuKirin', 'G2 Pro', '65'],     349.00, 411.00],
        [['VMAX', 'VX2 GEAR', '50'],      499.00, 587.00],
        [['VMAX', 'VX2 GEAR', '80'],      699.00, 822.00],
    ];

    public function up(): void
    {
        foreach (self::DEALS as [$needles, $price, $listPrice]) {
            $query = DB::table('products')->where('price', $price);

            foreach ($needles as $needle) {
                $query->where('title', 'like', '%' . $needle . '%');
            }

            $query->update(['list_price' => $listPrice]);
        }
    }

    public function down(): void
    {
        DB::table('products')
            ->whereIn('list_price', array_column(self::DEALS, 2))
            ->update(['list_price' => null]);
    }
};
