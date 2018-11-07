<?php

namespace App;
use Fico7489\Laravel\EloquentJoin\Traits\EloquentJoin;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    use EloquentJoin;
}
