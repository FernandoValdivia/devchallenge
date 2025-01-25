<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = 
        [
            'name',
            'position',
            'shirt_number',
            'team_id'
        ];
}

