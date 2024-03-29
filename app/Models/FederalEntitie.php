<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FederalEntitie extends Model
{
    use HasFactory;
    public function town()
    {
        return $this->hasMany('App\Models\Town');
    }
}
