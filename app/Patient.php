<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [
        'name',
        'email',
        'is_admitted',
        'bed_numbr',
        'admitted_by',
        'discharged_by',
        'discharged_at',
        'discharge_bill',
    ];

    public function bed(){
        return $this->belongsTo('App\Bed');
    }
}
