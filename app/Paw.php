<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paw extends Model
{
    public $table = 'Paw';
    //protected $primaryKey = 'id';
    //public $timestamps = false;
    //public $incrementing = false;

    protected $fillable = [
      //  'id'
        'name',
        'jenis_hewan',
        'jenis_kelamin',
        'warna',
        'berkembang_biak',
        'catatan'
    ];

    public function register()
    {
        return $this->belongsTo('App\PAw');
    }
}
