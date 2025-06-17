<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageView;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip();

        // Enregistre la vue seulement une fois par heure par IP
        PageView::updateOrCreate(
            [
                'ip_address' => $ip,
                'page' => '/',
                'created_at' => now()->startOfHour(),
            ],
            ['updated_at' => now()]
        );

        return view('welcome');
    }
}
