<?php

namespace App\Http\Controllers;

use App\Models\Bailleur; // Make sure you have a Bailleur model correctly set up
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class VoyageurController extends Controller
{
    public function allVoyageurs(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $voyageurs = User::where('role', 'voyageur')->get();

        return view('voyageur_views/allvoyageurs', ['voyageurs' => $voyageurs]);
    }

}
