<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $table = "faculties";
    protected $fillable = [
        'name','user_id',
    ];

    public function marketingCoordinator(){
        return $this->belongsTo("App\User","user_id");
    }
    public function students(){
        return $this->belongsToMany("App\User","faculty_student")->withTimestamps();
    }
}
