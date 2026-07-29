<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_USER_DEPRECATED);

$out = [];

$all = App\Models\Product::withoutGlobalScopes()->count();
$out[] = 'Produkte gesamt (ohne Scope)   : ' . $all;

$out[] = '';
$out[] = 'Nach Kategorie (ohne Scope):';
$rows = App\Models\Product::withoutGlobalScopes()
    ->selectRaw('category, count(*) n')->groupBy('category')->orderByDesc('n')->get();
$visible = array_keys(App\Models\Product::CATEGORIES);
foreach ($rows as $r) {
    $out[] = sprintf('  %-18s %5d  %s', $r->category, $r->n,
        in_array($r->category, $visible, true) ? 'SICHTBAR' : 'ausgeblendet');
}

$out[] = '';
$shopVisible = App\Models\Product::count();
$feed = App\Models\Product::where('price', '>', 0)->count();
$out[] = 'Im Shop sichtbar (Scope)       : ' . $shopVisible;
$out[] = 'Im Feed (Scope + Preis > 0)    : ' . $feed;
$out[] = 'Differenz (Preis = 0)          : ' . ($shopVisible - $feed);

$noPrice = App\Models\Product::where('price', '<=', 0)->get();
if ($noPrice->isNotEmpty()) {
    $out[] = '';
    $out[] = 'Sichtbar im Shop, aber NICHT im Feed (Preis 0):';
    foreach ($noPrice as $p) {
        $out[] = '  ' . $p->category . '  ' . Illuminate\Support\Str::limit($p->getTranslation('title', 'de'), 60);
    }
}

file_put_contents(base_path('audit.out'), implode(PHP_EOL, $out) . PHP_EOL);
