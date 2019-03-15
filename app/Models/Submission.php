<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        "name", "type", "user_id", "commented_at"
    ];

    public function submitter(){
        return $this->belongsTo("App\User","user_id");
    }
    public function comments(){
        return Comment::where("submission_id", $this->id)->orderBy("created_at","desc")->get();;
    }
}
