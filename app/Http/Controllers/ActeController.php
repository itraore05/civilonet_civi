<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActeController extends Controller
{
    public function show($type, $id)
    {
        $model = 'App\\Models\\' . ucfirst($type);
        return $model::with('demande.utilisateur')->findOrFail($id);
    }
}
