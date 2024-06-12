<?php
namespace App\Http\Controllers;

use App\Models\Bien;
use App\Models\Role;
use App\Models\Role_user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class ReservationController extends Controller
{
    public function reserverform($bien){
        return view('reserverform', ['bien' => $bien]);
    }



}
