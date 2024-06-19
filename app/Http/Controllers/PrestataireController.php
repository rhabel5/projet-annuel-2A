<?php

namespace App\Http\Controllers;

use App\Models\Bailleur;
use App\Models\Role_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class PrestataireController extends Controller
{


    public function inscription(){
        return view('prestataire.inscription');
    }

    public function create(Request $request){

 print_r($request->all());

        /*$prestataire = User::create($request->all());
        $roleUser = new Role_user;
        $roleUser->role_id = 4;
        $roleUser->user_id = Auth::id();
        $roleUser->save();*/
    }






    /*public function allPrestataires(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $prestataires = User::where('role', 'prestataire')->get();

        return view('presta_views/allpresta', ['prestataires' => $prestataires]);
    }*/

    public function destroy(User $prestataire)
    {
        $prestataire->delete();

        return redirect()->route('prestataires');
    }



}
