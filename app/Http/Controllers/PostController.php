<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Exceptions\PostNotFoundException;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('pages.admin.posts', compact('posts'));
    }

    public function show($postType, $post)
    {
        // Najít příspěvek na základě typu a slugu
        $post = Post::where('type', $postType)->where('slug', $post)->first();

        if (!$post) {
            throw new PostNotFoundException();
        } else {
            // Zde můžete provést další akce pro zobrazení příspěvku
            // Například, předat data do pohledu a zobrazit příspěvek
            return view('pages.post', compact('post'));
        }
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first();

        return view('pages.admin.prispevek.upravit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $id,
            'type' => 'required|in:film,serial,divadlo',
            'thumbnail' => 'nullable|max:2048'
        ]);

        $post = Post::findOrFail($id);
        if ($post) {
            $post->title = $request->input('title');
            $post->slug = $request->input('slug');
            $post->type = $request->input('type');
            $post->content = $request->input('content');
            $post->thumbnail = $request->input('thumbnail');
            $post->acting_at = $request->input('acting_at');
            $post->trailer_youtube_url = $request->input('trailer_video');
            $post->updated_at = Carbon::now();
            $post->save();

            return redirect('/admin/prispevky')->with('success', 'Příspěvek byl úspěšně upraven.');
        } else {
            return redirect('/admin/prispevky')->with('error', 'Příspěvek, který chcete upravit, se nepodařilo v databázi najít.');
        }
    }

    public function new()
    {
        return view('pages.admin.prispevek.novy');
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug',
            'type' => 'required|in:film,serial,divadlo',
            'thumbnail' => 'nullable|max:2048'
        ]);

        $post = new Post();
        $post->title = $request->input('title');
        $post->slug = $request->input('slug');
        $post->type = $request->input('type');
        $post->content = $request->input('content');
        $post->thumbnail = $request->input('thumbnail');
        $post->acting_at = $request->input('acting_at');
        $post->trailer_youtube_url = $request->input('trailer_video');
        $post->updated_at = Carbon::now();
        $post->save();

        return redirect('/admin/prispevky')->with('success', 'Příspěvek byl úspěšně vytvořen.');
    }
}
