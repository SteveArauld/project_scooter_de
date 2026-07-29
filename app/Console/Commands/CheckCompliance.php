<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

/**
 * Prüft die Angaben, die das Google Merchant Center und das deutsche
 * Impressumsrecht (§ 5 DDG) beanstanden, bevor der Shop live geht bzw.
 * eine erneute Überprüfung beantragt wird.
 *
 *   php artisan shop:check-compliance
 *
 * Exit-Code 1, sobald ein blockierender Punkt offen ist – so lässt sich der
 * Aufruf in ein Deployment-Skript hängen.
 */
class CheckCompliance extends Command
{
    protected $signature = 'shop:check-compliance';

    protected $description = 'Prüft Stammdaten, Telefonformat und Produktverfügbarkeit auf Merchant-Center-Konformität';

    /** Werte aus der Auslieferung, die vor dem Livegang ersetzt werden müssen. */
    private const PLACEHOLDERS = [
        'shop.ceo'            => ['Max Mustermann', 'Erika Mustermann', ''],
        'shop.register_no'    => ['HRB 123456 B', ''],
        'shop.register_court' => [''],
        'shop.vat_id'         => ['DE123456789', ''],
    ];

    public function handle(): int
    {
        $blocking = 0;

        $this->info('== Stammdaten (Impressum) ==');
        foreach (self::PLACEHOLDERS as $key => $bad) {
            $value = (string) config($key);
            if (in_array(trim($value), $bad, true)) {
                $this->error(sprintf('  FEHLER  %s ist ein Platzhalter: "%s"', $key, $value));
                $blocking++;
            } else {
                $this->line(sprintf('  ok      %s = %s', $key, $value));
            }
        }

        $this->newLine();
        $this->info('== Telefonnummer ==');
        $phone = (string) config('shop.phone');
        $digits = preg_replace('/\D+/', '', $phone);

        if (!str_starts_with(trim($phone), '+')) {
            $this->error('  FEHLER  Nummer nicht im internationalen Format (+49 …): ' . $phone);
            $blocking++;
        } elseif (str_starts_with($digits, '490')) {
            // "+49 0152 …" – die nationale Verkehrsausscheidungsziffer 0 gehört
            // hinter der Ländervorwahl nicht in die Nummer.
            $this->error('  FEHLER  Nach +49 folgt eine 0: ' . $phone);
            $blocking++;
        } else {
            $this->line('  ok      ' . $phone . '  (tel: ' . config('shop.phone_e164') . ')');
        }

        if (preg_replace('/\D+/', '', (string) config('shop.whatsapp')) !== $digits) {
            $this->warn('  HINWEIS WhatsApp-Nummer weicht von der Telefonnummer ab.');
        }

        $this->newLine();
        $this->info('== Produktverfügbarkeit ==');
        $preorders = Product::all()->filter->is_preorder;

        if ($preorders->isEmpty()) {
            $this->line('  ok      Keine Artikel mit künftigem Erscheinungsdatum.');
        } else {
            $this->line(sprintf('  %d Artikel werden als "preorder" ausgeliefert:', $preorders->count()));
            foreach ($preorders->sortBy->release_date as $p) {
                $this->line(sprintf(
                    '    %-11s  %s',
                    $p->release_date_iso,
                    \Illuminate\Support\Str::limit($p->getTranslation('title', 'de'), 60)
                ));
            }
        }

        // Artikel, deren Text ein Datum ankündigt, das sich nicht parsen lässt:
        // sie würden fälschlich als "in_stock" im Feed landen.
        $unparsed = Product::all()->filter(
            fn (Product $p) => str_contains(mb_strtolower((string) $p->availability), 'erscheint am')
                && $p->release_date === null
        );

        if ($unparsed->isNotEmpty()) {
            $this->error(sprintf(
                '  FEHLER  %d Artikel kündigen ein Datum an, das nicht gelesen werden konnte:',
                $unparsed->count()
            ));
            foreach ($unparsed as $p) {
                $this->error('    ' . $p->slug . ' – ' . $p->availability);
            }
            $blocking++;
        }

        $this->newLine();

        if ($blocking > 0) {
            $this->error($blocking . ' blockierende(r) Punkt(e) – bitte vor der erneuten Überprüfung im Merchant Center beheben.');

            return self::FAILURE;
        }

        $this->info('Alle geprüften Punkte sind in Ordnung.');

        return self::SUCCESS;
    }
}
