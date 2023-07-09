<?php

namespace App\Http\Controllers;

use App\Models\Navigation;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NavigationController extends Controller
{
    public function edit()
    {
        $navigationItems = Navigation::all();

        return view('pages.admin.nastaveni.navigace', compact('navigationItems'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'text' => 'required|array',
            'text.*' => 'required|string',
            'url' => 'required|array',
            'url.*' => 'required|string',
        ]);

        Navigation::truncate(); // Odstraňte stávající záznamy v tabulce "navigation"

        foreach ($request->text as $key => $text) {
            Navigation::create([
                'text' => $text,
                'url' => $request->url[$key],
            ]);
        }

        return redirect()->back()->with('success', 'Navigace byla aktualizována.');
    }
}
