<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipements;
use Illuminate\Support\Facades\Validator;

class EquipementController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string',
            'image_url' => 'required|string',
        ]);

        Equipements::create($validatedData);
    }
}
