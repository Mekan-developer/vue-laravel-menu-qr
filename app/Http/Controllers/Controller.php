<?php

namespace App\Http\Controllers;

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
        $filename = $random . '.' . $file->extension();
        $webpFilename = $random . '.webp';

        $img = $manager->read($file);







        // $random = Str::random(10);
        // $filename = $random . '.' . $file->extension();
        // $webpFilename = $random . '.webp';

        $web_image_width = 480;
        $tablet_image_width = 780;


        $height = Image::make($file)->height();
        $width = Image::make($file)->width();
        $scale = $height / $width;


        $web_image_height = $scale * $web_image_width;
        $tablet_image_height = $scale * $tablet_image_width;


        // Create folders if they don't exist
        create_folder('web_images');
        create_folder('tablet_images');


        Image::make($file)->encode('webp', 90)->resize($web_image_width, $web_image_height)->save(storage_path('app/public/web_images/' . $dir . '/' . $webpFilename));
        Image::make($file)->encode('webp', 90)->resize($tablet_image_width, $tablet_image_height)->save(storage_path('app/public/tablet_images/' . $dir . '/' . $webpFilename));

        return $webpFilename;
    }

    // protected function removeFile($file, $dir)
    // {

    //     $extension = explode('.', $file)[0];
    //     $fileJPG = $extension . '.jpg';
    //     $filePNG = $extension . '.png';

    //     file_remove($dir, $file);
    //     file_remove($dir, $fileJPG);
    //     file_remove($dir, $filePNG);

    // }

}
