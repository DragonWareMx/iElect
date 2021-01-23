<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;
    public function vote(){
        return $this->hasMany('App\Models\Vote');
    }
    public function campaign(){
        return $this->hasMany('App\Models\Campaign');
    }
}
