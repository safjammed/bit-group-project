<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        "name", "type", "user_id"
    ];

    public function submitter(){
        return $this->belongsTo("App\User","user_id");
    }
}
