<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations;

    protected $guarded = [];

    public array $translatable = ['title', 'description'];

    protected $casts = [
        'specifications' => 'array',
        'images'         => 'array',
        'raw_categories' => 'array',
        'price'          => 'decimal:2',
        'is_featured'    => 'boolean',
        'on_sale'        => 'boolean',
    ];

    /**
     * Im Shop sichtbare Kategorien. Der Shop führt ausschließlich
     * E-Roller (Elektroroller) und E-Scooter (E-Tretroller).
     * Diese Liste steuert Menü, Filter und den globalen Sichtbarkeits-Scope.
     */
    public const CATEGORIES = [
        'e-roller'  => 'E-Roller',
        'e-scooter' => 'E-Scooter',
    ];

    /**
     * Labels aller in den Quelldaten vorkommenden Kategorien
     * (nur für Anzeige/Import – nicht im Shop sichtbar).
     */
    public const ALL_CATEGORY_LABELS = [
        'e-roller'         => 'E-Roller',
        'e-scooter'        => 'E-Scooter',
        'e-bike'           => 'E-Bike',
        'e-chopper'        => 'E-Chopper',
        'e-kabinenroller'  => 'E-Kabinenroller',
        'microcar'         => 'Microcar',
        'seniorenmobil'    => 'Seniorenmobil',
        'e-lastenfahrrad'  => 'E-Lastenfahrrad',
        'zubehoer'         => 'Zubehör',
    ];

    /**
     * Globaler Scope: im gesamten Frontend werden ausschließlich
     * Produkte der sichtbaren Kategorien ausgeliefert.
     */
    protected static function booted(): void
    {
        static::addGlobalScope('visible', function ($query) {
            $query->whereIn('category', array_keys(self::CATEGORIES));
        });
    }

    /**
     * Untergruppen (Artikelart innerhalb einer Kategorie).
     */
    public const SUBCATEGORIES = [
        'neu'          => 'Neufahrzeuge',
        'zubehoer'     => 'Zubehör',
        'akku'         => 'Akkus & Ladegeräte',
        'ersatzteile'  => 'Ersatzteile',
        'tuning'       => 'Tuning',
    ];

    /** Icon (feather) je Kategorie – für die Kategorie-Kacheln. */
    public const CATEGORY_ICONS = [
        'e-roller'        => 'icon-truck',
        'e-scooter'       => 'icon-zap',
        'e-bike'          => 'icon-activity',
        'e-chopper'       => 'icon-wind',
        'e-kabinenroller' => 'icon-box',
        'microcar'        => 'icon-navigation',
        'seniorenmobil'   => 'icon-heart',
        'e-lastenfahrrad' => 'icon-package',
        'zubehoer'        => 'icon-tool',
    ];

    public function scopeCategory($query, ?string $slug)
    {
        return $slug ? $query->where('category', $slug) : $query;
    }

    public function scopeOnSale($query)
    {
        return $query->where('on_sale', true);
    }

    public function getSubcategoryLabelAttribute(): string
    {
        return self::SUBCATEGORIES[$this->subcategory] ?? 'Neufahrzeuge';
    }

    public function getCategoryIconAttribute(): string
    {
        return self::CATEGORY_ICONS[$this->category] ?? 'icon-truck';
    }

    /**
     * Deutsche Monatsnamen, wie sie im Verfügbarkeitstext der Quelldaten
     * vorkommen ("Dieses Produkt erscheint am 1. August 2026 …").
     */
    private const GERMAN_MONTHS = [
        'januar' => 1, 'februar' => 2, 'märz' => 3, 'maerz' => 3, 'april' => 4,
        'mai' => 5, 'juni' => 6, 'juli' => 7, 'august' => 8, 'september' => 9,
        'oktober' => 10, 'november' => 11, 'dezember' => 12,
    ];

    /**
     * Erscheinungsdatum aus dem Verfügbarkeitstext. Null, wenn der Artikel
     * kein angekündigtes Datum trägt.
     */
    public function getReleaseDateAttribute(): ?\Illuminate\Support\Carbon
    {
        $text = (string) $this->availability;

        if (!preg_match('/erscheint\s+am\s+(\d{1,2})\.\s*([\p{L}]+)\s+(\d{4})/iu', $text, $m)) {
            return null;
        }

        $month = self::GERMAN_MONTHS[mb_strtolower($m[2])] ?? null;
        if ($month === null) {
            return null;
        }

        try {
            return \Illuminate\Support\Carbon::createFromDate((int) $m[3], $month, (int) $m[1])->startOfDay();
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Vorbestellung: ein Erscheinungsdatum ist angekündigt und liegt noch
     * in der Zukunft. Bereits erschienene Artikel gelten wieder als lieferbar.
     */
    public function getIsPreorderAttribute(): bool
    {
        $release = $this->release_date;

        return $release !== null && $release->isFuture();
    }

    /** Erscheinungsdatum als ISO-8601-Datum (für Feed & strukturierte Daten). */
    public function getReleaseDateIsoAttribute(): ?string
    {
        return $this->release_date?->toDateString();
    }

    /** Verfügbarkeit im schema.org-Format (für Google Merchant Center). */
    public function getSchemaAvailabilityAttribute(): string
    {
        $text = mb_strtolower((string) $this->availability);

        if ($text === '' ) {
            return 'https://schema.org/InStock';
        }
        if (str_contains($text, 'ausverkauft') || str_contains($text, 'nicht verfügbar')) {
            return 'https://schema.org/OutOfStock';
        }
        // Angekündigtes, noch nicht erreichtes Erscheinungsdatum
        if ($this->is_preorder) {
            return 'https://schema.org/PreOrder';
        }
        if (str_contains($text, 'vorbestell')) {
            return 'https://schema.org/PreOrder';
        }

        return 'https://schema.org/InStock';
    }

    /** Herstellernummer (MPN) – aus der Produktnummer der Quelle. */
    public function getMpnAttribute(): ?string
    {
        return $this->reference ?: null;
    }

    /**
     * Verfügbarkeit im Format des Google-Merchant-Center-Feeds.
     * Erlaubte Werte: in_stock | out_of_stock | preorder | backorder
     */
    public function getFeedAvailabilityAttribute(): string
    {
        return match ($this->schema_availability) {
            'https://schema.org/OutOfStock' => 'out_of_stock',
            'https://schema.org/PreOrder'   => 'preorder',
            default                         => 'in_stock',
        };
    }

    /** Google-Produktkategorie laut Taxonomie (aus der Konfiguration). */
    public function getGoogleCategoryAttribute(): ?string
    {
        return config('shop.google_categories.' . $this->category);
    }

    /** Reiner Text der Beschreibung (für Meta-Description & strukturierte Daten). */
    public function plainDescription(int $limit = 300): string
    {
        $raw = $this->getTranslation('description', 'de') ?: '';
        $raw = trim(preg_replace('/\s+/', ' ', strip_tags($raw)));

        return $limit > 0 ? \Illuminate\Support\Str::limit($raw, $limit, '') : $raw;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /**
     * URL absolue de l'image principale.
     */
    public function getMainImageAttribute(): string
    {
        $images = $this->images ?: [];
        if (!empty($images[0])) {
            return '/' . ltrim($images[0], '/');
        }
        return '/assets/images/products/product-img-1.jpg';
    }

    /**
     * Toutes les images en URL absolues.
     */
    public function imageUrls(): array
    {
        return collect($this->images ?: [])
            ->map(fn ($i) => '/' . ltrim($i, '/'))
            ->all();
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::ALL_CATEGORY_LABELS[$this->category] ?? 'E-Roller';
    }

    /**
     * Kategorie + Untergruppe aus den Quell-Kategorien / dem Titel ableiten.
     * Gibt ['category' => slug, 'subcategory' => slug, 'on_sale' => bool] zurück.
     */
    public static function resolveCategory(array $rawCategories, string $title = '', string $url = ''): array
    {
        $onSale = in_array('Sale', $rawCategories, true);

        // Quell-Kategorie -> interner Slug
        $map = [
            'e-roller'         => 'e-roller',
            'e-scooter'        => 'e-scooter',
            'e-bike'           => 'e-bike',
            'e-chopper'        => 'e-chopper',
            'e-kabinenroller'  => 'e-kabinenroller',
            'microcar'         => 'microcar',
            'seniorenmobil'    => 'seniorenmobil',
            'seniorenmobile'   => 'seniorenmobil',
            'e-lastenfahrrad'  => 'e-lastenfahrrad',
        ];
        $subMap = [
            'neu'         => 'neu',
            'zubehoer'    => 'zubehoer',
            'zubehör'     => 'zubehoer',
            'akku'        => 'akku',
            'ersatzteile' => 'ersatzteile',
            'tuning'      => 'tuning',
        ];

        $category = null;
        $subcategory = null;

        foreach ($rawCategories as $raw) {
            if ($raw === 'Alle-Produkte' || $raw === 'Sale') {
                continue;
            }
            $parts = explode('/', $raw);
            $head = mb_strtolower(trim($parts[0]));
            $tail = isset($parts[1]) ? mb_strtolower(trim($parts[1])) : null;

            if ($category === null && isset($map[$head])) {
                $category = $map[$head];
            }
            if ($subcategory === null && $tail !== null && isset($subMap[$tail])) {
                $subcategory = $subMap[$tail];
            }
            // Eigenständige Zubehör-/Tuning-Kategorie ohne Fahrzeugtyp
            if ($category === null && isset($subMap[$head])) {
                $subcategory = $subMap[$head];
            }
        }

        // Fallback: aus Titel/URL ableiten (viele Artikel tragen den Typ im Namen)
        if ($category === null) {
            $hay = mb_strtolower($title . ' ' . $url);
            $needles = [
                'e-kabinenroller'  => ['kabinenroller'],
                // "seniorenmobi" fängt auch abgeschnittene Quell-Titel ab
                'seniorenmobil'    => ['seniorenmobi', 'elektromobil'],
                'e-lastenfahrrad'  => ['lastenfahrrad', 'lastenrad', 'cargobike'],
                'microcar'         => ['microcar', 'mikrocar'],
                'e-chopper'        => ['e-chopper', 'chopper'],
                'e-bike'           => ['e-bike', 'ebike', 'pedelec', 'fahrrad'],
                'e-scooter'        => ['e-scooter', 'escooter'],
                'e-roller'         => ['e-roller', 'eroller', 'roller', 'motorroller'],
            ];
            foreach ($needles as $slug => $words) {
                foreach ($words as $w) {
                    if (str_contains($hay, $w)) {
                        $category = $slug;
                        break 2;
                    }
                }
            }
        }

        // Zubehörteile ohne Fahrzeugbezug
        if ($category === null) {
            $hay = mb_strtolower($title . ' ' . $url);
            foreach (['akku', 'ladegerät', 'ladegeraet', 'charger', 'helm', 'pumpe', 'reifen',
                      'schlauch', 'spiegel', 'tasche', 'schloss', 'handschuh', 'ersatzteil'] as $w) {
                if (str_contains($hay, $w)) {
                    $category = 'zubehoer';
                    break;
                }
            }
        }

        $category ??= 'zubehoer';

        // Untergruppe aus dem Titel nachziehen, wenn nicht gesetzt
        if ($subcategory === null) {
            $hay = mb_strtolower($title . ' ' . $url);
            if (str_contains($hay, 'akku') || str_contains($hay, 'ladegerät') || str_contains($hay, 'ladegeraet')) {
                $subcategory = 'akku';
            } elseif ($category === 'zubehoer') {
                $subcategory = 'zubehoer';
            }
        }

        return [
            'category'    => $category,
            'subcategory' => $subcategory ?? 'neu',
            'on_sale'     => $onSale,
        ];
    }
}
