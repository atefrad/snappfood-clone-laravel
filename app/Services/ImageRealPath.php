<?php

namespace App\Services;

class ImageRealPath
{
    public static function getImageRealPath(string $image): string
    {
        return substr(
            $image,
            strpos($image, '/storage') +
            strlen('/storage/'
            )
        );
    }
}
