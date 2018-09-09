<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Projectmemory extends Model
{
    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected $appends = ['completion'];

    public function getCompletionAttribute(){
        if ($this->completed == 1) {
            return "complete";
        } elseif ($this->participation_level or $this->production_memories or $this->performance_memories){
            return "in progress";
        } else {
            return "empty";
        }
    }
}
