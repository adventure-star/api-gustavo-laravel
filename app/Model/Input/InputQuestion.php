<?php

namespace App\Model\Input;

use Illuminate\Database\Eloquent\Model;

class InputQuestion extends Model
{
    protected $table = 'input_questions';

    public function answers()
    {
        return $this->hasMany(InputAnswer::class, 'question_id', 'id');
    }
}
