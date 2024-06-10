<?php

namespace App\Http\Controllers;
use App\Models\Equipements;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {

        try {
            for($i = 1; $i <= 5; $i++) {
                $fileKey = "image{$i}";
                if($request->hasFile($fileKey)) {
                    $request->validate([
                      $fileKey => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    $imageName = time(). '_' .$i . '.'. $request->file($fileKey)->extension();
                    $request->file($fileKey)->move(public_path('images'), $imageName);
                    echo $imageName;
                    $Image = Image::create([
                        'id_bien' => $request->get('id_bien'),
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
