<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dept extends Model
{
    //
    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }
}
