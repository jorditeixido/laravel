<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    public function escuela()
    {
        return $this->belongsTo('App\Escuela','escuela_id','id');
    }
}
