<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =[
        "content", "user_id", "submission_id",
    ];

    public function commenter(){
        return $this->belongsTo("App\User", "user_id");
    }

    public function submission(){
        return $this->belongsTo("App\Models\Submission","submission_id");
    }
}
