<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    
    public function election(){
        return $this->belongsTo('App\Models\Election');
    }
    
    public function politic_partie(){
        return $this->belongsTo('App\Models\PoliticPartie');
    }
    
    public function section(){
        return $this->belongsTo('App\Models\Section');
    }
    
    public function position(){
        return $this->belongsTo('App\Models\Position');
    }
}
