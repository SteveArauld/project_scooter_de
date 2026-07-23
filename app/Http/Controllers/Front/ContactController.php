<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public const SUBJECTS = [
        'beratung'     => 'Beratung zu einem Fahrzeug',
        'bestellung'   => 'Frage zu meiner Bestellung',
        'versand'      => 'Versand und Lieferung',
        'garantie'     => 'Garantie oder Reparatur',
        'ruecksendung' => 'Rückgabe und Widerruf',
        'sonstiges'    => 'Sonstiges',
    ];

    public function index()
    {
        return view('front.contact.index', [
            'subjects' => self::SUBJECTS,
        ]);
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:120',
            'email'   => 'required|email|max:180',
            'phone'   => 'nullable|string|max:40',
            'subject' => 'required|string|in:' . implode(',', array_keys(self::SUBJECTS)),
            'message' => 'required|string|max:5000',
            'privacy' => 'accepted',
        ], [
            'privacy.accepted' => 'Bitte bestätigen Sie die Datenschutzerklärung.',
        ]);

        // Lesbaren Betreff speichern statt des Schlüssels
        $validated['subject'] = self::SUBJECTS[$validated['subject']];

        try {
            Mail::to(config('shop.email'))->send(new ContactMessage($validated));
        } catch (\Throwable $e) {
            report($e);

            return back()
                ->withInput()
                ->withErrors(['message' => 'Ihre Nachricht konnte nicht gesendet werden. Bitte versuchen Sie es später erneut oder rufen Sie uns an.']);
        }

        return redirect()
            ->route('contact')
            ->with('success', 'Vielen Dank für Ihre Nachricht. Wir melden uns in der Regel innerhalb eines Werktages bei Ihnen.');
    }
}
