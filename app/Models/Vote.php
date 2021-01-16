<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    
    public function election(){
        return $this->belongsTo('App\Election');
    }
    
    public function politic_partie(){
        return $this->belongsTo('App\Politic_Partie');
    }
    
    public function section(){
        return $this->belongsTo('App\Section');
    }
    //FALTA la de puestos
}
