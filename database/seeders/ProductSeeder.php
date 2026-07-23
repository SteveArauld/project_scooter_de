<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $path = database_path('datas/products_laravel.json');
        if (!is_file($path)) {
            $this->command->error("Fichier introuvable : {$path}");
            return;
        }

        $data = json_decode(file_get_contents($path), true);
        $products = $data['products'] ?? [];

        // Der globale Sichtbarkeits-Scope darf beim Import nicht greifen.
        Product::withoutGlobalScopes()->delete();

        $usedSlugs = [];   // Slug-Eindeutigkeit im Speicher (schneller als DB-Abfragen)
        $perCategory = []; // zum Verteilen der "is_featured"-Produkte
        $imported = 0;
        $skipped = 0;

        foreach ($products as $p) {
            $title = trim($p['title']['de'] ?? '');
            if ($title === '' || $this->isTestArticle($title)) {
                $skipped++;
                continue;
            }

            $slug = $this->makeSlug($p, $title, $usedSlugs);
            $specs = is_array($p['specifications'] ?? null) ? $p['specifications'] : [];
            $raw = is_array($p['categories'] ?? null) ? $p['categories'] : [];

            $resolved = Product::resolveCategory($raw, $title, $p['url'] ?? '');
            $cat = $resolved['category'];

            // pro Kategorie die ersten 2 Produkte hervorheben
            $perCategory[$cat] = ($perCategory[$cat] ?? 0) + 1;

            Product::create([
                'slug'             => $slug,
                'reference'        => $this->cleanReference($p['reference'] ?? null),
                'title'            => $this->cleanTranslations($p['title'] ?? []),
                'description'      => $this->cleanTranslations($p['description'] ?? []),
                'description_html' => $p['description_html'] ?? null,
                'price'            => (float) ($p['price']['value'] ?? 0),
                'currency'         => $p['price']['currency'] ?? 'EUR',
                'availability'     => $p['availability'] ?? null,
                'brand'            => $this->resolveBrand($p, $specs, $title),
                'category'         => $cat,
                'subcategory'      => $resolved['subcategory'],
                'on_sale'          => $resolved['on_sale'],
                'raw_categories'   => $raw,
                'specifications'   => $specs,
                'images'           => is_array($p['images'] ?? null) ? $p['images'] : [],
                'source_url'       => $p['url'] ?? null,
                'is_featured'      => $perCategory[$cat] <= 2,
            ]);
            $imported++;
        }

        $this->command->info("{$imported} Produkte importiert" . ($skipped ? " ({$skipped} ohne Titel übersprungen)" : '') . '.');

        $visible = array_keys(Product::CATEGORIES);
        foreach (Product::withoutGlobalScopes()->selectRaw('category, count(*) as n')->groupBy('category')->pluck('n', 'category') as $c => $n) {
            $this->command->line(sprintf('  %-18s %5d  %s', $c, $n, in_array($c, $visible, true) ? '(im Shop sichtbar)' : '(ausgeblendet)'));
        }
    }

    /** Test-/Dummy-Artikel des Lieferanten gehören nicht in den Shop. */
    private function isTestArticle(string $title): bool
    {
        foreach (['testdummy', 'test dummy', 'nicht bestellbar'] as $needle) {
            if (stripos($title, $needle) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Sprechenden Slug aus dem Titel bilden (SEO). Der Bildordner dient nur als
     * Rückfallebene – er heißt bei vielen Artikeln generisch "Alle-Produkte".
     */
    private function makeSlug(array $p, string $title, array &$used): string
    {
        $slug = Str::limit(Str::slug($title), 90, '');

        // Rückfallebene: Bildordner, sofern er nicht generisch ist
        if ($slug === '' && !empty($p['images'][0])) {
            $parts = explode('/', $p['images'][0]);
            $idx = array_search('product', $parts, true);
            if ($idx !== false && isset($parts[$idx + 1])) {
                $candidate = Str::slug($parts[$idx + 1]);
                if (!in_array($candidate, ['alle-produkte', 'sale', 'neu'], true)) {
                    $slug = $candidate;
                }
            }
        }
        $slug = $slug ?: 'produkt';

        $base = $slug;
        $n = 1;
        while (isset($used[$slug])) {
            $slug = $base . '-' . (++$n);
        }
        $used[$slug] = true;

        return $slug;
    }

    private function cleanReference(?string $ref): ?string
    {
        $ref = trim(str_replace('Produktnummer:', '', (string) $ref));
        return $ref !== '' ? $ref : null;
    }

    /** Marke aus dem Feld, den Spezifikationen oder dem ersten Wort des Titels. */
    private function resolveBrand(array $p, array $specs, string $title): ?string
    {
        $brand = trim((string) ($p['brand'] ?? ''));
        if ($brand !== '') {
            return $brand;
        }
        foreach (['Marke:', 'Marke', 'Hersteller:', 'Hersteller'] as $key) {
            if (!empty($specs[$key]) && is_string($specs[$key])) {
                return trim($specs[$key]);
            }
        }
        $first = trim(explode(' ', $title)[0] ?? '');
        return $first !== '' ? $first : null;
    }

    private function cleanTranslations(array $t): array
    {
        $out = [];
        foreach ($t as $locale => $value) {
            if (is_string($value) && trim($value) !== '') {
                $out[$locale] = $value;
            }
        }
        return $out ?: ['de' => ''];
    }
}
