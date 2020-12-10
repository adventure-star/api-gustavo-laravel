<?php

namespace App\Model\Input;

use App\Model\Base\Image;
use Illuminate\Database\Eloquent\Model;

class InputImage extends Model
{
    protected $table = 'input_images';

    public function image()
    {
        return $this->belongsTo(Image::class, 'image_id', 'id');
    }
}
