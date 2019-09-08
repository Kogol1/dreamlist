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
    //Primary key
      public $primaryKey = 'id';
    //Timestamps
      public $timeStamps = true;

    public function getMonthAttribute()
    {
        return Carbon::parse($this->done)->format('m');
    }
}
