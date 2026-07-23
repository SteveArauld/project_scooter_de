<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

/**
 * Erzeugt die Produktdatei für das Google Merchant Center als echte Datei
 * auf der Festplatte – zum manuellen Upload oder für den geplanten Abruf.
 */
class GenerateMerchantFeed extends Command
{
    /*
     * Hinweis: Die Datei darf NICHT nach public/merchant-feed.xml geschrieben
     * werden – eine statische Datei dort würde die gleichnamige Route
     * überdecken, da der Webserver Dateien vor Laravel ausliefert.
     */
    protected $signature = 'feed:merchant
                            {--path= : Zielpfad der XML-Datei (Standard: storage/app/merchant-feed.xml)}
                            {--force : Warnung zu APP_URL überspringen (für Cronjobs)}';

    protected $description = 'Erzeugt den Google-Merchant-Center-Produktfeed als XML-Datei';

    public function handle(): int
    {
        $products = Product::query()
            ->where('price', '>', 0)
            ->orderBy('id')
            ->get();

        if ($products->isEmpty()) {
            $this->error('Es sind keine Produkte in der Datenbank vorhanden.');
            $this->line('Bitte zuerst den Import ausführen: php artisan db:seed --class=ProductSeeder');

            return self::FAILURE;
        }

        /*
         * Alle Links im Feed werden aus APP_URL gebildet. Zeigt diese noch auf
         * localhost, weist das Merchant Center den Feed ab ("Ungültige URL").
         */
        $appUrl = (string) config('app.url');
        $isLocal = str_contains($appUrl, 'localhost') || str_contains($appUrl, '127.0.0.1');

        if ($isLocal) {
            $this->warn('ACHTUNG: APP_URL steht auf "' . $appUrl . '".');
            $this->line('Alle Produkt- und Bild-URLs im Feed zeigen dadurch auf localhost.');
            $this->line('Google Merchant Center akzeptiert das nicht.');
            $this->line('Vor dem Livegang in der .env setzen, z. B.:');
            $this->line('   APP_URL=https://ihre-domain.de');
            $this->newLine();

            if (!$this->option('force') && !$this->confirm('Trotzdem fortfahren?', true)) {
                return self::FAILURE;
            }
        }

        $xml = trim(view('front.feeds.merchant', compact('products'))->render());

        $path = $this->option('path') ?: storage_path('app/merchant-feed.xml');

        $dir = dirname($path);
        if (!is_dir($dir) && !mkdir($dir, 0775, true) && !is_dir($dir)) {
            $this->error("Verzeichnis konnte nicht angelegt werden: {$dir}");

            return self::FAILURE;
        }

        if (file_put_contents($path, $xml) === false) {
            $this->error("Datei konnte nicht geschrieben werden: {$path}");

            return self::FAILURE;
        }

        $this->info('Merchant-Feed erfolgreich erzeugt.');
        $this->table(
            ['Datei', 'Artikel', 'Größe'],
            [[$path, $products->count(), number_format(filesize($path) / 1024, 1, ',', '.') . ' KB']]
        );

        $byCategory = $products->groupBy('category')->map->count();
        foreach ($byCategory as $category => $count) {
            $this->line(sprintf('  %-12s %d', $category, $count));
        }

        $this->newLine();
        $this->line('Abruf-URL für das Merchant Center: ' . url('/merchant-feed.xml'));

        return self::SUCCESS;
    }
}
