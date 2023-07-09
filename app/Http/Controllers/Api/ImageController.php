<?php

namespace App\Http\Controllers\Api;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controller;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();

        if ($images->isEmpty()) {
            return response()->json(['error' => 'Žádné obrázky nejsou k dispozici']);
        } else {
            return response()->json(['data' => $images]);
        }
    }

    public function upload(Request $request)
    {
        // Zkontrolujte, zda byl odeslán soubor
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // Zkontrolujte, zda nebyla přijata chyba při nahrávání
            if ($file->isValid()) {
                $filename = $file->getClientOriginalName();

                $path = $file->storeAs('public/assets/uploads/img', $filename);

                $image = Image::create([
                    'filename' => $filename,
                    'path' => "/storage/assets/uploads/img/$filename"
                ]);

                // Soubor byl úspěšně nahrán
                // Zde můžete provést další manipulace nebo uložení informací o obrázku do databáze

                if($image) {
                    return response()->json(['message' => 'Obrázek byl úspěšně nahrán'], 200);
                } else {
                    return response()->json(['message' => 'Nahrávání obrázku se nezdařilo'], 500);
                }
            }
        } else {
            return response()->json(['message' => 'Nebyl vybrán obrázek k nahrání'], 500);
        }
    }
}
