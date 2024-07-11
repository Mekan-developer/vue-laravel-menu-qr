<?php


if (!function_exists('create_folder')) {
    function create_folder($folder)
    {
        $path_foods = storage_path('app/public/' . $folder . '/foods');
        $path_categories = storage_path('app/public/' . $folder . '/categories');

        // Check if directories exist, if not create them
        if (!Storage::exists($path_foods)) {
            Storage::makeDirectory($path_foods, 0777, true, true);
        }
        if (!Storage::exists($path_categories)) {
            Storage::makeDirectory($path_categories, 0777, true, true);
        }
    }
}