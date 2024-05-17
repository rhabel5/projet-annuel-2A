<?php

namespace App\Http\Controllers;

use App\Models\Bailleur; // Make sure you have a Bailleur model correctly set up
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class PrestataireController extends Controller
{
    public function allPrestataires(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $prestataires = User::where('role', 'prestataire')->get();

        return view('presta_views/allpresta', ['prestataires' => $prestataires]);
    }

    public function destroy(User $prestataire)
    {
        $prestataire->delete();

        return redirect()->route('prestataires');
    }

}
