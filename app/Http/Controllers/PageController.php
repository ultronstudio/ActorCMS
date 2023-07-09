<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showBySlug(Request $request, $slug)
    {
        // Pokud je slug prázdný, přesměrujte na domovskou stránku
        if ($slug == '') {
            return redirect('/'); // Nastavte cílovou URL vaší domovské stránky
        }

        // Vyhledejte stránku na základě slugu
        $page = Page::where('slug', $slug)->first();

        // Pokud stránka neexistuje, zobrazte chybovou stránku 404
        if (!$page) {
            return abort(404);
        }

        // Pokud stránka existuje, načtěte příslušný pohled a předávejte data stránky
        return view('pages.page', compact('page'));
    }
}
