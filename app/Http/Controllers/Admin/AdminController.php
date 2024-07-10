<?php

namespace App\Http\Controllers\Admin;

use App\Models\Element;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bien;
use App\Models\Ticket;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $ticketCount = Ticket::count();
        $biensToValidateCount = Bien::where('valide', false)->count();

        return view('admin.index', compact('userCount', 'ticketCount', 'biensToValidateCount'));
    }

    public function showElement($id)
    {
        $element = Element::find($id);
        return view('admin.show', compact('element'));
    }

    public function editElement($id)
    {
        $element = Element::find($id);
        return view('admin.edit', compact('element'));
    }

    public function updateElement(Request $request, $id)
    {
        $element = Element::find($id);
        $element->update($request->all());
        return redirect()->route('admin.index')->with('success', 'Element updated successfully');
    }

    public function deleteElement($id)
    {
        $element = Element::find($id);
        $element->delete();
        return redirect()->route('admin.index')->with('success', 'Element deleted successfully');
    }
}