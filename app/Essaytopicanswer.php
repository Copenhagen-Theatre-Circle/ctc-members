<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Essaytopicanswer extends Model
{
    protected $guarded = [];

    protected $appends = ['completion'];

    public function getCompletionAttribute(){
        if ($this->completed == 1) {
            return "complete";
        } elseif ($this->answer_question_1 or $this->answer_question_2 or $this->answer_question_3 or $this->answer_question_4){
            return "in progress";
        } else {
            return "empty";
        }
    }
}
