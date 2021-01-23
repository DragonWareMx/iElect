<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    public function vote(){
        return $this->hasMany('App\Models\Vote');
    }    
    public function federal_district(){
        return $this->belongsTo('App\Models\FederalDistrict');
    }
    
    public function local_district(){
        return $this->belongsTo('App\Models\LocalDistrict');
    }
    public function elector(){
        return $this->hasMany('App\Models\Elector');
    }
    public function campaign(){
        return $this->belongsToMany('App\Models\Campaign');
    }
}
