<?php

namespace App\Http\Controllers;
use App\Models\Equipements;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController
{
    public function store(Request $request)
    {
        try {
            for($i = 0; $i < 5; $i++) {
                $fileKey = "file-upload{$i}";
                if($request->hasFile($fileKey)) {
                    $request->validate([
                        $fileKey => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    $imageName = time() . $request->nom . '.' . $request->$fileKey->extension();
                    $request->$fileKey->move(public_path('images'), $imageName);

                    $Image = Image::create([
                        'id_bien' => $request->id,
                        'chemin' => 'public/images/'.$imageName,
                    ]);
                }
            }

            return back()
                ->with('success','Image(s) ajoutée(s) avec succès.');

        } catch (\Exception $e) {

            return back()
                ->with('error', 'Une erreur s\'est produite lors de l\'ajout des images : ' . $e->getMessage());
        }
    }
}
