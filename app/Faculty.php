<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = "facultys";
    protected $fillable = [
        'name', 'email', 'phone','faculty'
    ];
}
