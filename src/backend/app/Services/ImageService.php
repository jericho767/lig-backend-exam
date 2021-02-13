<?php

namespace App\Services;

use App\Models\Image;

class ImageService
{
    /**
     * Create an image entry.
     *
     * @param array $data
     * @return Image
     */
    public function createImage(array $data): Image
    {
        $image = new Image([
            'url' => $data['url'],
            'imageable_type' => $data['imageable_type'],
            'imageable_id' => $data['imageable_id'],
        ]);
        $image->save();

        return $image;
    }
}
