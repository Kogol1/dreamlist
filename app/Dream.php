<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Dream extends Model
{

    protected $fillable = [
        'title'
    ];
    //Primary key
      public $primaryKey = 'id';
    //Timestamps
      public $timeStamps = true;

    public function getMonthAttribute()
    {
        return Carbon::parse($this->attributes['done'])->format('m');
    }
}
