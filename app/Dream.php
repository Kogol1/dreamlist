<?php

namespace App;

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
}
