<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    
    public function federal_entitie(){
        return $this->belongsTo('App\Federal_Entitie');
    }
    public function federal_district(){
        return $this->belongsToMany('App\Federal_District');
    }
    public function local_district(){
        return $this->belongsToMany('App\Local_District');
    }

}
