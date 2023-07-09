<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use Illuminate\Routing\Controller;

class PanelController extends Controller
{
    public function index()
    {
        $last_post = Post::all()->last();

        return view('pages.admin.panel', compact('last_post'));
    }
}
