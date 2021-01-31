<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    public function position(){
        return $this->belongsTo('App\Models\Position');
    }
    public function privacy_document(){
        return $this->hasMany('App\Models\PrivacyDocument');
    }
    public function user(){
        return $this->belongsToMany('App\Models\User');
    }
    public function politic_partie(){
        return $this->belongsToMany('App\Models\PoliticPartie');
    }
    public function section(){
        return $this->belongsToMany('App\Models\Section');
    }
    public function elector(){
        return $this->hasMany('App\Models\Elector');
    }


}
