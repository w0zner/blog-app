<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function show(Post $post)
    {
        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('is_published', true)
            ->whereHas('tags', function ($query) use ($post) {
                $query->whereIn('tags.id', $post->tags->pluck('id'));
            })
            ->orWhere('category_id', $post->category_id)
            ->limit(4)
            ->get();
        
        return view('posts.show', compact('post', 'relatedPosts'));
    }
}
