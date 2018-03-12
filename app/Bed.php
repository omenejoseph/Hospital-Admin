<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Bed extends Model
{
    //
    protected $fillable = ['name', 'ward_id', 'is_occupied', 'patient_id'];

    public function ward(){
        return $this->belongsTo('App\Ward');
    }

    
}
