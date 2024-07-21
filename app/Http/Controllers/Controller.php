<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

use Illuminate\Support\Str;

abstract class Controller
{
    protected function uploadFile($file, $dir)
    {

        // create image manager with desired driver
        $manager = new ImageManager(new Driver());
        $random = hexdec(uniqid());
        // $filename = $random . '.' . $file->extension();
        $webpFilename = $random . '.webp';

        $img = $manager->read($file);

        $web_image_width = 480;
        $tablet_image_width = 780;

        $height = $img->height();
        $width = $img->width();
        $scale = $height / $width;

        $web_image_height = $scale * $web_image_width;
        $tablet_image_height = $scale * $tablet_image_width;


        create_folder('web_images');
        create_folder('tablet_images');


        $web_img = $img->resize($web_image_width, $web_image_height);
        $web_img->toWebp(90)->save(storage_path('app/public/web_images/' . $dir . '/' . $webpFilename));

        $tablet_img = $img->resize($tablet_image_width, $tablet_image_height);
        $tablet_img->toWebp(90)->save(storage_path('app/public/tablet_images/' . $dir . '/' . $webpFilename));
        return $webpFilename;
    }

    protected function removeFile($file, $dir)
    {
        $imagePathWeb = 'public/web_images/' . $dir . '/' . $file;
        $imagePathTablet = 'public/tablet_images/' . $dir . '/' . $file;

        if (Storage::exists($imagePathWeb)) {
            Storage::delete($imagePathWeb);
        }
        if (Storage::exists($imagePathTablet)) {
            Storage::delete($imagePathTablet);
        }
    }

}
