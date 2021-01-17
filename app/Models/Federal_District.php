<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Federal_District extends Model
{
    use HasFactory;
    public function section(){
        return $this->hasMany('App\Section');
    }
    public function town(){
        return $this->belongsToMany('App\Town');
    }
    
}
