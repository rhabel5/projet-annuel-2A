<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use Illuminate\Http\Request;

class AdminBienController extends Controller
{
    public function index()
    {
        $biens = Bien::all();
        return view('admin.biens.index', compact('biens'));
    }
}