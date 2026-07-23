<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class FAQController extends Controller
{
    public function index()
    {
        $categories = [
            [
                'title' => 'Fahrzeuge & Zulassung',
                'icon'  => 'icon-truck',
                'questions' => [
                    [
                        'question' => 'Was ist der Unterschied zwischen einem E-Roller und einem E-Scooter?',
                        'answer'   => 'Ein E-Roller ist ein Elektroroller mit Sitzposition, vergleichbar mit einem klassischen Motorroller. Er eignet sich für längere Strecken und bietet je nach Modell Platz für zwei Personen. Ein E-Scooter ist ein Elektro-Tretroller, den Sie im Stehen fahren. Er ist kompakt, meist faltbar und ideal für kurze Wege und die letzte Meile.',
                    ],
                    [
                        'question' => 'Welchen Führerschein benötige ich?',
                        'answer'   => 'Für E-Scooter mit ABE benötigen Sie keinen Führerschein, das Mindestalter beträgt 14 Jahre. Für E-Roller bis 25 km/h genügt eine Mofa-Prüfbescheinigung. Für E-Roller bis 45 km/h benötigen Sie mindestens die Führerscheinklasse AM. Schnellere Modelle erfordern die Klasse A1 oder höher. Die erforderliche Klasse ist bei jedem Fahrzeug in der Produktbeschreibung angegeben.',
                    ],
                    [
                        'question' => 'Brauche ich eine Versicherung?',
                        'answer'   => 'Ja. Sowohl E-Scooter mit ABE als auch E-Roller benötigen ein Versicherungskennzeichen. Dieses erhalten Sie bei jeder Kfz-Versicherung. Das Versicherungsjahr läuft jeweils vom 1. März bis zum 28. bzw. 29. Februar.',
                    ],
                    [
                        'question' => 'Sind die Fahrzeuge für den Straßenverkehr zugelassen?',
                        'answer'   => 'Alle von uns angebotenen Fahrzeuge mit entsprechender Kennzeichnung verfügen über eine Allgemeine Betriebserlaubnis (ABE) oder EG-Typgenehmigung und dürfen damit im öffentlichen Straßenverkehr gefahren werden. Ob ein Modell zugelassen ist, entnehmen Sie bitte der jeweiligen Produktbeschreibung.',
                    ],
                ],
            ],
            [
                'title' => 'Akku & Reichweite',
                'icon'  => 'icon-battery-charging',
                'questions' => [
                    [
                        'question' => 'Wie hoch ist die tatsächliche Reichweite?',
                        'answer'   => 'Die angegebene Reichweite ist ein Herstellerwert unter optimalen Bedingungen. In der Praxis sollten Sie je nach Fahrergewicht, Streckenprofil, Außentemperatur und Fahrweise mit etwa 20 bis 30 Prozent weniger rechnen. Bei Kälte unter 5 °C kann die Reichweite deutlicher sinken.',
                    ],
                    [
                        'question' => 'Wie lange dauert das Laden?',
                        'answer'   => 'Je nach Akkukapazität und Ladegerät dauert eine vollständige Ladung zwischen 4 und 8 Stunden. Die konkrete Ladezeit finden Sie in den technischen Daten des jeweiligen Fahrzeugs.',
                    ],
                    [
                        'question' => 'Kann ich den Akku herausnehmen und in der Wohnung laden?',
                        'answer'   => 'Bei vielen unserer E-Roller und nahezu allen E-Scootern ist der Akku entnehmbar und kann bequem an jeder Haushaltssteckdose geladen werden. Ob ein Modell einen herausnehmbaren Akku hat, ist in den technischen Daten vermerkt.',
                    ],
                    [
                        'question' => 'Wie lange hält ein Akku?',
                        'answer'   => 'Lithium-Ionen-Akkus erreichen üblicherweise 800 bis 1.000 vollständige Ladezyklen, bevor die Kapazität spürbar nachlässt. Bei durchschnittlicher Nutzung entspricht das mehreren Jahren. Ein normaler Kapazitätsverlust durch Alterung ist von der Garantie ausgenommen.',
                    ],
                ],
            ],
            [
                'title' => 'Bestellung & Zahlung',
                'icon'  => 'icon-shopping-cart',
                'questions' => [
                    [
                        'question' => 'Wie gebe ich eine Bestellung auf?',
                        'answer'   => 'Legen Sie das gewünschte Fahrzeug in den Warenkorb und gehen Sie zur Kasse. Dort geben Sie Ihre Liefer- und Kontaktdaten ein und schließen die Bestellung ab. Eine Registrierung ist nicht erforderlich. Sie erhalten anschließend eine Bestätigung per E-Mail.',
                    ],
                    [
                        'question' => 'Welche Zahlungsarten werden akzeptiert?',
                        'answer'   => 'Sie können per Vorkasse überweisen, auf Rechnung kaufen (für Bestands- und Gewerbekunden) oder bei Abholung in einer unserer Filialen bar bzw. mit EC-Karte bezahlen. Eine Übersicht finden Sie auf der Seite Zahlungsarten.',
                    ],
                    [
                        'question' => 'Sind die Preise inklusive Mehrwertsteuer?',
                        'answer'   => 'Ja. Alle angegebenen Preise sind Endpreise in Euro und enthalten die gesetzliche Mehrwertsteuer von 19 Prozent. Zusätzliche Versandkosten fallen innerhalb Deutschlands nicht an.',
                    ],
                    [
                        'question' => 'Kann ich meine Bestellung ändern oder stornieren?',
                        'answer'   => 'Solange Ihre Bestellung noch nicht versandt wurde, können Sie sie jederzeit ändern oder stornieren. Kontaktieren Sie uns dafür bitte umgehend telefonisch oder per E-Mail unter Angabe Ihrer Bestellnummer.',
                    ],
                ],
            ],
            [
                'title' => 'Versand, Rückgabe & Service',
                'icon'  => 'icon-package',
                'questions' => [
                    [
                        'question' => 'Was kostet der Versand?',
                        'answer'   => 'Der Versand innerhalb Deutschlands ist für Sie kostenlos. Es fallen keine zusätzlichen Liefer- oder Versandkosten an.',
                    ],
                    [
                        'question' => 'Wie lange dauert die Lieferung?',
                        'answer'   => 'Die übliche Lieferzeit beträgt 5 bis 8 Werktage ab Bestellung. Fahrzeuge werden per Spedition zugestellt. Sobald Ihre Bestellung unser Lager verlässt, erhalten Sie eine Sendungsverfolgung per E-Mail.',
                    ],
                    [
                        'question' => 'Kommt das Fahrzeug fahrfertig an?',
                        'answer'   => 'Ja. Jedes Fahrzeug wird bei uns vor dem Versand aufgebaut, geprüft und Probe gefahren. Sie müssen lediglich den Akku laden und gegebenenfalls Spiegel oder Lenker ausrichten.',
                    ],
                    [
                        'question' => 'Wie kann ich ein Fahrzeug zurückgeben?',
                        'answer'   => 'Sie haben ein gesetzliches Widerrufsrecht von 14 Tagen ab Erhalt der Ware. Melden Sie den Widerruf bitte per E-Mail oder telefonisch an, damit wir die Abholung organisieren können. Die Kosten der Rücksendung übernehmen wir.',
                    ],
                    [
                        'question' => 'Was leistet die Garantie?',
                        'answer'   => 'Auf alle Fahrzeuge gewähren wir zusätzlich zur gesetzlichen Gewährleistung eine Herstellergarantie von 24 Monaten auf Material- und Verarbeitungsfehler. Verschleißteile wie Reifen und Bremsbeläge sowie normaler Kapazitätsverlust des Akkus sind davon ausgenommen.',
                    ],
                ],
            ],
        ];

        return view('front.faq.index', compact('categories'));
    }
}
