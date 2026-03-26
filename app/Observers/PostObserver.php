<?php

namespace App\Observers;

class PostObserver
{
    function created($post)
    {
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post creado con éxito',
            'text' => 'El nuevo post ha sido agregado.',
            'theme' => 'auto',
        ]);
    }

    function updating($post)
    {
        if ($post->is_published && ! $post->published_at) {
            $post->published_at = now();
        }
    }

    function updated($post)
    {
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'Post actualizado con éxito',
            'text' => 'El post ha sido actualizado.',
            'theme' => 'auto',
        ]);
    }
}
