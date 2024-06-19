<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TypePrestation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PrestationTypeController extends Controller {

    public function form() {
        $user = Auth::user();

        return view('prestationType.form');
    }


    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
        'nom'=> 'required|string|max:255',
        'description' => 'required|string|max:255',
        'prix_moyen' => 'required|int|max:255',
        'pourcentage_pcs' => 'required|int|max:255',
        'prerequis' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

        $prestationType = new TypePrestation();
                $prestationType->nom = $request->input('nom');
                $prestationType->description = $request->input('description');
                $prestationType->prix_moyen = $request->input('prix_moyen');
                $prestationType->pourcentage_pcs = $request->input('pourcentage_pcs');
                $prestationType->prerequis = $request->input('prerequis');
                $prestationType->save();

        return back()
            ->with('success','Le type de prestation a été ajouté avec succes.');


    }

}
