<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ResizeImage implements ShouldQueue
{
    use Queueable;
    public $image_path;

    /**
     * Create a new job instance.
     */
    public function __construct($image_path)
    {
        $this->image_path = $image_path;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $upload = Storage::disk('public')->get($this->image_path);

        //$filename = pathinfo($this->image_path, PATHINFO_FILENAME) . '.' . pathinfo($this->image_path, PATHINFO_EXTENSION);

        $image = Image::decode($upload)->scale(width: 1200)
        ->encodeUsingFileExtension(pathinfo($this->image_path, PATHINFO_EXTENSION), quality: 70);

        Storage::disk('public')->put(
            $this->image_path,
            $image
        );

        //$validated['image_path'] = 'posts/' . $filename;
    }
}
