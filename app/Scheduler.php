<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scheduler extends Model
{
    protected $fillable = ['event_type_id','scheduled_date','start_time','end_time','first_name','last_name','email'];
}
