<?php

namespace App\Model;

use App\Model\Input\InputImage;
use App\Model\Input\InputQuestion;
use App\Model\Input\InputText;
use App\Model\Input\InputVideo;
use Illuminate\Database\Eloquent\Model;

class PartBoard extends Model
{
    protected $table = 'board_parts';

    public function inputimage()
    {
        return $this->belongsTo(InputImage::class, 'inputimage_id', 'id');
    }
    public function inputvideo()
    {
        return $this->belongsTo(InputVideo::class, 'inputvideo_id', 'id');
    }
    public function inputtext()
    {
        return $this->belongsTo(InputText::class, 'inputtext_id', 'id');
    }
    public function inputquestion()
    {
        return $this->belongsTo(InputQuestion::class, 'inputquestion_id', 'id');
    }
}
