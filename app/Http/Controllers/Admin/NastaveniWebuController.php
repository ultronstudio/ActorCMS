<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NastaveniWebu;
use Illuminate\Http\Request;

class NastaveniWebuController extends Controller
{
    public function edit()
    {
        $nastaveniWebu = NastaveniWebu::first(); // Předpokládáme, že je pouze jedno nastavení webu

        return view('pages.admin.nastaveni.web', compact('nastaveniWebu'));
    }

    public function update(Request $request)
    {
        $nastaveniWebu = NastaveniWebu::first();

        if (!$nastaveniWebu) {
            // Pokud neexistuje žádné nastavení webu, vytvoříme nový záznam
            $nastaveniWebu = new NastaveniWebu();
        }

        $nastaveniWebu->fill($request->all());
        $nastaveniWebu->save();

        return redirect('/admin/nastaveni')->with('success', 'Nastavení webu bylo úspěšně uloženo.');
    }

    public function vzhled()
    {
        $nastaveniWebu = NastaveniWebu::first(); // Předpokládáme, že existuje pouze jedno nastavení webu

        return view('pages.admin.nastaveni.vzhled', compact('nastaveniWebu'));
    }

    public function ulozitVzhled(Request $request)
    {
        $nastaveniWebu = NastaveniWebu::first();

        if (!$nastaveniWebu) {
            // Pokud neexistuje žádné nastavení webu, vytvoříme nový záznam
            $nastaveniWebu = new NastaveniWebu();
        }

        // Uložení hodnot pro vzhled do modelu NastaveniWebu
        $nastaveniWebu->logo = $request->input('logo');
        $nastaveniWebu->ikona = $request->input('icon');
        $nastaveniWebu->primary_color = $request->input('primary_color');
        $nastaveniWebu->secondary_color = $request->input('secondary_color');
        $nastaveniWebu->font_family = $request->input('font_family');

        $nastaveniWebu->save();

        return redirect('/admin/nastaveni')->with('success', 'Nastavení vzhledu bylo úspěšně uloženo.');
    }
}
