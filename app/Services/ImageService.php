<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Image;

class ImageService
{
    public static function upload($imageFile)
    {
        $fileName = uniqid(rand() . '_');
        $extention = $imageFile->extension();
        $fileNameToStore = $fileName . '.' . $extention;

        Storage::putFileAs('public', $imageFile, $fileNameToStore);

        return $fileNameToStore;
    }
}
