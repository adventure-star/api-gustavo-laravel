<?php

namespace App\Model\Input;

use App\Model\Base\Video;
use Illuminate\Database\Eloquent\Model;

class InputVideo extends Model
{
    protected $table = 'input_videos';

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id', 'id');
    }
}
