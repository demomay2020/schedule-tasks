<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['event_name','event_duration','user_id'];
    protected $guarded = ['id'];
}
