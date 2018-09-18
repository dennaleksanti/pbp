<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class register extends Model
{
    public $table = 'register';
    //protected $primaryKey = 'id';
    //public $timestamps = false;
    //public $incrementing = false;

    protected $fillable = [
      //  'id'
        'username',
        'email',
        'password',
        'role_id'
    ];
}
