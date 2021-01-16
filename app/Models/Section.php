<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function vote(){
        return $this->hasMany('App\Vote');
    }    
    public function federal_district(){
        return $this->belongsTo('App\Federal_District');
    }
    
    public function local_district(){
        return $this->belongsTo('App\Local_District');
    }
}
