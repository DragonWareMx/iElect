<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    
    public function federal_entitie(){
        return $this->belongsTo('App\Models\FederalEntitie');
    }
    public function federal_district(){
        return $this->belongsToMany('App\Models\FederalDistrict');
    }
    public function local_district(){
        return $this->belongsToMany('App\Models\LocalDistrict');
    }

}
