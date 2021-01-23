<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalDistrict extends Model
{
    use HasFactory;
    public function section(){
        return $this->hasMany('App\Models\Section');
    }
    public function town(){
        return $this->belongsToMany('App\Models\Town');
    }
    
}
