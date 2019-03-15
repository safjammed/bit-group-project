<?php

namespace App\Http\Controllers;

use App\Models\Closure;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    //
    public function deleteSubmission(Submission $submission)
    {
        if ($submission->delete()){
            return redirect()->route("allSubmissions")->withSuccess("The submission has been removed");
        }else{
            return redirect()->route("allSubmissions")->withErrors(['The Submission Could Not Be removed']);
        }
    }

    public function selectForPublishing(Submission $submission)
    {
       if ($submission->update(['selected' => true]))
       {
           return redirect()->route("allSubmissions")->withSuccess("The Submission Has been Selected");
       }else{
           return redirect()->route("allSubmissions")->withErrors(['The Submission Could Not Be Selected']);
       }
    }

    public function getSubmissionStatus(Submission $submission)
    {
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
        if ($comment_date != null && $comment_date->diffInDays($creation_date) < 15 && $final_closure->greaterThanOrEqualTo($comment_date) ){
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
