<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Closure extends Model
{
    protected $fillable = [
        "academic_year", "closure", "final_closure", "faculty_id"
    ];

    public function faculty(){
        return $this->belongsTo("App\Models\Faculty");
    }
}
