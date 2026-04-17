<?php

namespace App\Listeners;

use App\Events\UploadedImage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ResizeImage
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UploadedImage $event): void
    {
        $upload = Storage::disk('public')->get($event->image_path);

        $image = Image::decode($upload)->scale(width: 1200)
        ->encodeUsingFileExtension(pathinfo($event->image_path, PATHINFO_EXTENSION), quality: 70);

        Storage::disk('public')->put(
            $event->image_path,
            $image
        );
    }
}
