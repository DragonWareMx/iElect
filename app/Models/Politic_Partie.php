<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Politic_Partie extends Model
{
    use HasFactory;
    public function vote(){
        return $this->hasMany('App\Vote');
    }
}
