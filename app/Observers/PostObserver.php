<?php

namespace App\Observers;

class PostObserver
{
    function updating($post)
    {
        if ($post->is_published && ! $post->published_at) {
            $post->published_at = now();
        }
    }
}
