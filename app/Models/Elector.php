<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elector extends Model
{
    use HasFactory;
    public function job(){
        return $this->belongsTo('App\Job');
    }
    public function section(){
        return $this->belongsTo('App\Section');
    }
    public function campaign(){
        return $this->belongsTo('App\Campaign');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}
