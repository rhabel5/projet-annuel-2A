<?php

namespace App\Http\Controllers;
use App\Models\Bien;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{


    public function store(Request $request, Bien $bien)
    {

        $imagesdejapostee = Image::where('id_bien',$bien->id)->count();

        if ($imagesdejapostee >= 5) {
            return back()->with('error', 'Le nombre maximum de 5 images pour ce bien a été atteint.');
        }
        try {
            $request->validate([
                'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);



            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $index => $file) {
                    $imageName = time() . '_' . ($index + 1) . '.' . $file->extension();
                    $file->move(public_path('images'), $imageName);

                    $imagesdejapostee = Image::where('id_bien',$bien->id)->count();

                    if ($imagesdejapostee >= 5) {
                        return back()->with('error', 'Le nombre maximum de 5 images pour ce bien a été atteint.');
                    }

                    $image = Image::create([
                        'id_bien' => $bien->id,
                        'chemin' => 'images/' . $imageName,
                    ]);

                    if (!$image) {
                        return back()->with('error', 'Une erreur s\'est produite lors de l\'ajout des images.');
                    }
                }
            }

            return redirect()->route('mesbiens');

        } catch (\Exception $e) {
            return back()->with('error', 'Une erreur s\'est produite lors de l\'ajout des images : ' . $e->getMessage());
        }
    }


    public function voirimagesbien(Bien $bien){

        return view('bien.voirimagesbien', ['bien' => $bien]);
    }
}
