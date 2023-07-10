<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();

        return view('pages.admin.pages', compact('pages'));
    }

    public function edit($id)
    {
        $page = Page::where('id', $id)->first();

        return view('pages.admin.stranka.upravit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $id,
        ]);

        $page = Page::findOrFail($id);
        if ($page) {
            $page->title = $request->input('title');
            $page->slug = $request->input('slug');
            $page->content = $request->input('content');
            $page->updated_at = Carbon::now();
            $page->save();

            return redirect('/admin/stranky')->with('success', 'Příspěvek byl úspěšně upraven.');
        } else {
            return redirect('/admin/stranky')->with('error', 'Příspěvek, který chcete upravit, se nepodařilo v databázi najít.');
        }
    }

    public function new()
    {
        return view('pages.admin.stranka.nova');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug'
        ]);

        $post = new Page();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->content = $request->input('content');
        $post->updated_at = Carbon::now();
        $post->save();

        return redirect('/admin/stranky')->with('success', 'Stránka byla úspěšně vytvořena.');
    }
}
