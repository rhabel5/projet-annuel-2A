<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    // Méthode pour afficher la page d'accueil du backoffice
    public function index()
    {
        return view('admin.index');
    }

    // Méthode pour gérer la création d'un nouvel élément dans le backoffice
    public function create()
    {
        return view('admin.create');
    }

    // Méthode pour gérer l'édition d'un élément existant dans le backoffice
    public function edit($id)
    {
        $element = Element::find($id);
        return view('admin.edit', compact('element'));
    }

    // Méthode pour gérer la suppression d'un élément dans le backoffice
    public function delete($id)
    {
        $element = Element::find($id);
        $element->delete();
        return redirect()->route('admin.index')->with('success', 'Element deleted successfully');
    }

    // Méthode pour gérer l'affichage des détails d'un élément dans le backoffice
    public function show($id)
    {
        $element = Element::find($id);
        return view('admin.show', compact('element'));
    }
}