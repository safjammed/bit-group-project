<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Submission;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    //
    public function addComment(Request $request)
    {

        //submission
        $submission = Submission::findOrFail($request->input("submission_id"));

        $submissionController = new SubmissionController();
        $status = $submissionController->getSubmissionStatus($submission);
//        dd(Carbon::now()->format( 'Y-m-d'));
        if (
            $status->status != "expired"
            && Auth::user()->hasRole('marketing coordinator')
            && $submission->faculty_id == Auth::user()->faculty()->id
            && $submission->commented_at == null){
//            return "here";
            //update comment
            $submission->update(['commented_at' => Carbon::now()]);
        }


        if (Comment::create([
            "content" => $request->input("content"),
            "user_id" =>  Auth::id(),
            "submission_id" => $submission->id,
        ])){
            return redirect()->back()->withSuccess("The Comment Has been Added");
        }else{
            return redirect()->back()->withInput()->withErrors(['The Comment Could Not Be Added']);
        }
    }
}
