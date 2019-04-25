<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        "name", "type", "user_id", "commented_at","selected", "closure_id", "faculty_id"
    ];

    public function submitter(){
        return $this->belongsTo("App\User","user_id");
    }
    public function comments(){
        return Comment::where("submission_id", $this->id)->orderBy("created_at","desc")->get();;
    }
    public function closure(){
        return $this->belongsTo("App\Models\Closure");
    }
    public function faculty(){
        return $this->belongsTo("App\Models\Faculty");
    }

    public function getStatus()
    {
        $submission = $this;
        //check Status
        $closure = Closure::where("academic_year",date("Y") )
            ->where("faculty_id", $submission->faculty_id)
            ->first();



        $creation_date = Carbon::createFromFormat('Y-m-d H:s:i', $submission->created_at);
        $current_date = Carbon::now();
        $update_date = Carbon::createFromFormat('Y-m-d H:s:i', $submission->updated_at);
        $comment_date = $submission->commented_at != null ? Carbon::createFromFormat("Y-m-d H:s:i", $submission->commented_at) : null;
//        dd($comment_date);

        $closure_date = Carbon::createFromFormat("Y-m-d",$closure->closure);
        $final_closure = Carbon::createFromFormat("Y-m-d",$closure->final_closure);
        //if comment is made within 15 days
        if ($comment_date != null && $comment_date->diffInDays($creation_date,false) < 15 && $final_closure->greaterThanOrEqualTo($comment_date) ){
            $status = "approved";
        }else{
            $status = "expired";
        }

        if ($comment_date == null && $creation_date->diffInDays($current_date) < 15 && $final_closure->greaterThanOrEqualTo($comment_date) ){
            $status = "waiting";
        }

        if ($submission->selected == true){
            $status ="selected";
        }


        //check if updatable
        if ($final_closure->greaterThanOrEqualTo($current_date)){
            $updatable = true;
        }



        return (object)[
            "status" => $status,
            "update" => $updatable
        ];
    }
}
