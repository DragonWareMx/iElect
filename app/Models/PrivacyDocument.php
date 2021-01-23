<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivacyDocument extends Model
{
    use HasFactory;
    public function campaign(){
        return $this->belongsTo('App\Models\Campaign');
    }
}
