<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\OrderAdminNotification;
use App\Mail\OrderCustomerConfirmation;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        return view('front.checkout.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|max:150',
            'phone'      => 'required|string|max:40',
            'address'    => 'required|string|max:255',
            'zip'        => 'required|string|max:20',
            'city'       => 'required|string|max:100',
            'country'    => 'required|string|max:100',
            'notes'      => 'nullable|string|max:2000',
            'items'      => 'required|json',

            // Abweichende Lieferadresse (nur erforderlich, wenn angehakt)
            'different_shipping'  => 'nullable|boolean',
            'shipping_first_name' => 'required_if:different_shipping,1|nullable|string|max:100',
            'shipping_last_name'  => 'required_if:different_shipping,1|nullable|string|max:100',
            'shipping_address'    => 'required_if:different_shipping,1|nullable|string|max:255',
            'shipping_zip'        => 'required_if:different_shipping,1|nullable|string|max:20',
            'shipping_city'       => 'required_if:different_shipping,1|nullable|string|max:100',
            'shipping_country'    => 'required_if:different_shipping,1|nullable|string|max:100',
        ], [
            'shipping_first_name.required_if' => 'Bitte geben Sie den Vornamen für die Lieferadresse an.',
            'shipping_last_name.required_if'  => 'Bitte geben Sie den Nachnamen für die Lieferadresse an.',
            'shipping_address.required_if'    => 'Bitte geben Sie die abweichende Lieferanschrift an.',
            'shipping_zip.required_if'        => 'Bitte geben Sie die Postleitzahl der Lieferadresse an.',
            'shipping_city.required_if'       => 'Bitte geben Sie den Ort der Lieferadresse an.',
            'shipping_country.required_if'    => 'Bitte geben Sie das Land der Lieferadresse an.',
        ]);

        $rawItems = json_decode($data['items'], true) ?: [];
        if (empty($rawItems)) {
            return back()->withErrors(['items' => 'Ihr Warenkorb ist leer.'])->withInput();
        }

        // Recalcul serveur des prix (sécurité : ne pas faire confiance au client)
        $items = [];
        $total = 0.0;
        foreach ($rawItems as $line) {
            $product = Product::where('slug', $line['slug'] ?? '')->first();
            if (!$product) {
                continue;
            }
            $qty = max(1, (int) ($line['qty'] ?? 1));
            $lineTotal = (float) $product->price * $qty;
            $total += $lineTotal;
            $items[] = [
                'title'      => $product->getTranslation('title', 'de'),
                'slug'       => $product->slug,
                'reference'  => $product->reference,
                'price'      => (float) $product->price,
                'qty'        => $qty,
                'line_total' => $lineTotal,
                'image'      => $product->main_image,
            ];
        }

        if (empty($items)) {
            return back()->withErrors(['items' => 'Ihr Warenkorb ist leer.'])->withInput();
        }

        // Lieferadresse: entweder abweichend oder identisch mit der Rechnungsadresse
        $differentShipping = (bool) ($data['different_shipping'] ?? false);
        $shipping = $differentShipping
            ? [
                'first_name' => $data['shipping_first_name'],
                'last_name'  => $data['shipping_last_name'],
                'address'    => $data['shipping_address'],
                'zip'        => $data['shipping_zip'],
                'city'       => $data['shipping_city'],
                'country'    => $data['shipping_country'],
            ]
            : [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'address'    => $data['address'],
                'zip'        => $data['zip'],
                'city'       => $data['city'],
                'country'    => $data['country'],
            ];

        $order = [
            'number'             => 'ER-' . strtoupper(Str::random(8)),
            'customer'           => $data,
            'shipping'           => $shipping,
            'different_shipping' => $differentShipping,
            'items'              => $items,
            'total'              => $total,
            'currency'           => 'EUR',
            'date'               => now()->format('d.m.Y H:i'),
        ];

        $adminEmail = config('shop.order_email') ?: config('mail.from.address');

        try {
            Mail::to($adminEmail)->send(new OrderAdminNotification($order));
            Mail::to($data['email'])->send(new OrderCustomerConfirmation($order));
        } catch (\Throwable $e) {
            report($e);
            return back()
                ->withErrors(['mail' => 'Die Bestellung konnte nicht versendet werden. Bitte versuchen Sie es später erneut.'])
                ->withInput();
        }

        return view('front.checkout.success', ['order' => $order]);
    }
}
