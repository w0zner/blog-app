<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use App\Http\Requests\UpdatePostRequest;
use App\Jobs\ResizeImage;
use App\Events\UploadedImage;
use App\Http\Middleware\IsAdmin;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Gate;


class PostController extends Controller //implements HasMiddleware
{

//    public static function middleware() {
//         return [
//             new Middleware('is_admin', only: [ 'edit', 'update', 'destroy', 'publish']),
//         ];
//    }



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
        /* $tags = $post->tags->pluck('id')->toArray();
        $response = in_array(1, $tags);*/

            //Gate::authorize('is_admin');

         $categories = Category::all();
         $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //Llama al form request para validar los datos
        $validated = $request->validated();

        if($request->hasFile('image')) {
            if($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }

            $extension = $request->image->getClientOriginalExtension();
            $filename = $post->slug . '.' . $extension;

            while(Storage::disk('public')->exists('posts/' . $filename)) {
                $filename = $post->slug . '-' . time() . '.' . $extension;
            }

            $validated['image_path'] = Storage::disk('public')->putFileAs('posts', $request->image, $filename);

            //Llama al job para redimensionar la imagen
            //ResizeImage::dispatch($validated['image_path']);

            //Llama al evento para redimensionar la imagen
            UploadedImage::dispatch($validated['image_path']);

           /*  $upload = $request->file('image');
            $image = Image::decode($upload)->scale(width: 1200)
            ->encodeUsingFileExtension($upload->getClientOriginalExtension(), quality: 70);

            Storage::disk('public')->put(
                'posts/' . $filename,
                $image
            );

            $validated['image_path'] = 'posts/' . $filename; */

            //$validated['image_path'] = Storage::disk('public')->put('posts', $request->image);
        }

        $validated['user_id'] = auth()->id();

        $post->update($validated);

        $tags = [];

        foreach($request->tags ?? [] as $tag) {
            $tags[] = Tag::firstOrCreate(['name' => $tag]);
            //$tags[] = $tag->id;
        }

        $post->tags()->sync($tags);

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
