<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UrlController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query('query');

        // Získání seznamu URL z databáze na základě zadaného dotazu
        $pages = Page::where('url', 'LIKE', "%$query%")->pluck('url');
        $posts = Post::where('url', 'LIKE', "%$query%")->pluck('url');

        $urls = $pages->merge($posts)->unique()->values();

        return response()->json(['data' => $urls]);
    }
}
