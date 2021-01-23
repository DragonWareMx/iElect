<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoliticPartie extends Model
{
    use HasFactory;
    public function vote(){
        return $this->hasMany('App\Models\Vote');
    }
    public function campaign(){
        return $this->belongsToMany('App\Models\Campaign');
    }
}
