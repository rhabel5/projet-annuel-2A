<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipements;
use Illuminate\Support\Facades\Validator;

class EquipementsController extends Controller
{
    public function create()
    {
        return view('biens_views/ajout_equipement');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time(). $request->nom. '.' .$request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        $Equipement = Equipements::create([
            'nom' => $request->nom,
            'image_url' => 'images/'.$imageName,
        ]);

        return back()
            ->with('success','L\'équipement a été créé avec succès.')
        ->with('image',$imageName);

    }

    public function select()
    {
        return view('biens_views/selection_equipement');
    }
}
