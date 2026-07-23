<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class CareerController extends Controller
{
    public function index()
    {
        $jobs = [
            ['title' => 'Verkaufsberater (m/w/d)',        'location' => 'Berlin',   'type' => 'Vollzeit'],
            ['title' => 'Zweiradmechaniker (m/w/d)',      'location' => 'München',  'type' => 'Vollzeit'],
            ['title' => 'Mitarbeiter Kundenservice (m/w/d)', 'location' => 'Remote', 'type' => 'Teilzeit'],
            ['title' => 'Lagerlogistiker (m/w/d)',         'location' => 'Hamburg',  'type' => 'Vollzeit'],
        ];

        return view('front.career.index', compact('jobs'));
    }
}
