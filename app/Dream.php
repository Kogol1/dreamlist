<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dream extends Model
{
    use SoftDeletes;


    protected $fillable = [
        'title'
    ];
    protected $appends = [
        'delta_time',
        'month'
    ];
    //Primary key
      public $primaryKey = 'id';
    //Timestamps
      public $timeStamps = true;


    public function users()
    {
        return $this->belongsToMany(User::class, 'dream_user');
    }

    public function getMonthAttribute()
    {
        return Carbon::parse($this->done)->format('m');
    }
    public function  getDeltaTimeAttribute()
    {
            $start = Carbon::parse($this->created_at);
            $end = Carbon::parse($this->done);
            $delta = $end->diffInHours($start);
            return $delta;
    }


}
