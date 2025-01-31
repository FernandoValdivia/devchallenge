<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = 
        [
            'name',
            'short_name',
            'tla',
            'area',
            'venue',
            'founded'
        ];
}