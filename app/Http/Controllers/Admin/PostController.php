<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category', 'user')->latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug',
            'category_id' => 'required|exists:categories,id',
        ]);

        $validated['user_id'] = auth()->id();

        $post = Post::create($validated);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post creado con éxito',
            'text' => 'El nuevo post ha sido agregado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
         $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:posts,slug,' . $post->id,
            'category_id' => 'required|exists:categories,id',
            'excerpt' => 'required_if:is_published,1|string',
            'content' => 'required_if:is_published,1|string',
            'is_published' => 'boolean',
        ]);

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado con éxito',
            'text' => 'El post ha sido actualizado.',
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function publish(Post $post)
    {

        if($post->is_published == 0 && ! $post->published_at) {
            $post->published_at = now();
        }

        $post->update(['is_published' => ! $post->is_published]);

        session()->flash('swal-flash', [
            'position' => 'top-end',
            'icon' => 'success',
            'title' => 'Estado de publicación actualizado',
            'text' => 'El post \'' . $post->slug . '\' se ha sido actualizado como ' . ($post->is_published ? 'PUBLICADO' : 'NO PUBLICADO') . '.',
            'showConfirmButton' => false,
            'timer' => 1500,
            'theme' => 'auto',
        ]);

        return redirect()->route('admin.posts.index', $post);
    }
}
