<?php


if (!function_exists('create_folder')) {
    function create_folder($folder)
    {
        $path_foods = 'public/' . $folder . '/foods';
        $path_categories = 'public/' . $folder . '/categories';

        // Check if directories exist, if not create them
        if (!Storage::disk('local')->exists($path_foods)) {
            Storage::disk('local')->makeDirectory($path_foods, 0777, true, true);
        }
        if (!Storage::disk('local')->exists($path_categories)) {
            Storage::disk('local')->makeDirectory($path_categories, 0777, true, true);
        }
    }
}