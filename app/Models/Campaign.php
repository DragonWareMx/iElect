<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function position(){
        return $this->belongsTo('App\Position');
    }
    public function privacy_document(){
        return $this->hasMany('App\Privacy_Document');
    }
    public function user(){
        return $this->belongsToMany('App\User');
    }
    public function politic_partie(){
        return $this->belongsToMany('App\Politic_Partie');
    }
    public function section(){
        return $this->belongsToMany('App\Section');
    }


}
