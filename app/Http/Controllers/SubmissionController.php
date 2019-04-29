<?php

namespace App\Http\Controllers;

use App\extras\Mailer;
use App\Models\Closure;
use App\Models\Faculty;
use App\Models\Submission;
use Carbon\Carbon;
use Chumper\Zipper\Zipper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class SubmissionController extends Controller
{
    //
    public function deleteSubmission(Submission $submission)
    {
        $roles = Auth::user()->getRoleNames();
        if (
            ($roles->first() == "super-admin" ) ||
            ($roles->first() == "student" && $submission->user_id == Auth::id()) ||
            ($roles->first() == "marketing coordinator" && $submission->faculty_id == Auth::user()->faculty()->id)
        )
        {}else{
            return redirect()->to("/");
        }
        $file_path = public_path("uploads/submissions/".$submission->name);
        if (File::exists($file_path) && File::delete($file_path) && $submission->delete() ){
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

        $updatable =false;

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

    public function selectForPublication(Submission $submission)
    {
        $status = $submission->getStatus();
        $errors = [];
        if ($status->status == "waiting"){
            array_push($errors, "Submission has to be commented first");
        }
        if ($status->status == "expired"){
            array_push($errors, "The Submission is expired");
        }
        if ($status->status == "selected"){
            array_push($errors, "The submission is already selected");
        }
        if ($status->status ==  "approved"){
            if ($submission->update([
                "selected" => 1
            ])){
                return redirect()->route("allSubmissions")->withSuccess("The Submission Has been Selected");
            }else{
                array_push($errors, "The Submission Could not be selected");
            }
        }

        return redirect()->back()->withInput()->withErrors($errors);

    }
    public function unSelectForPublication(Submission $submission)
    {
        $status = $submission->getStatus();
        $errors = [];
        if($status->status != "expired" && $status->status != "waiting" && $status->status == "selected"){
            if ($submission->update([
                "selected" => false
            ])){
                return redirect()->route("allSubmissions")->withSuccess("The Submission Has been Unselected");
            }else{
                array_push($errors, "The Submission Could not be Unselected");
            }
        }

        return redirect()->back()->withInput()->withErrors($errors);

    }

    public function downloadSelectedZip($year = false){
        if ($year == false){
            $year = date("Y");
        }
        if (strtotime($year) === false) {
            return abort(404);
        }
        //get closure
        $closure = Closure::where("academic_year",$year)->pluck("id");
        $submissions = Submission::whereIN("closure_id",$closure)->where("selected", true)->get();

        $zipper = new Zipper();
        //make zip file
        $zipFile = public_path("zip/submissions_".$year.".zip");
        $zipper->make($zipFile);
        foreach ($submissions as $index => $submission){
            $file = public_path("uploads/submissions/".$submission->name);
            $zipper->folder( $submission->submitter->name )->add($file);
        }
        $zipper->close();
        return response()->download($zipFile);
    }

    public function addSubmission(Request $request)
    {
        //validate the request
        $request->validate([
            'agree'=>'required',
            'upload' => 'required|mimes:doc,docx,png,jpg,gif,jpeg',
            'faculty_id'=>'required|numeric',
        ]);
        $document_mime = ['doc', 'docx'];
        $images_mime = ['png', 'jpg', 'gif'];
        $file = $request->file('upload');
        $filetype = $file->getClientOriginalExtension();

        $faculty = Faculty::findOrFail($request->input("faculty_id"));

        //check Status
        $closure = Closure::where("academic_year",date("Y") )
            ->where("faculty_id", $request->input("faculty_id"))
            ->first();
        $closure_date = Carbon::createFromFormat("Y-m-d",$closure->closure);
//        $final_closure = Carbon::createFromFormat("Y-m-d",$closure->final_closure);
        $now = Carbon::now();
        if ($now->diffInDays($closure_date, false) < 15 ){
            // upload process starts here
            if(in_array($filetype,$document_mime)){
                $type = "document";
            }elseif(in_array($filetype,$images_mime)){
                $type =  "picture";
            }
            //save file
            $filename = time().$file->getClientOriginalName();
            if ($file->move(public_path("uploads/submissions"), $filename)){
                //file uploaded entry in database
                /*$statement = Submission::create([
                    "name"=> $filename,
                    "type" => $type,
                    "user_id" => Auth::id()
                ]);*/
                $submission = new Submission();
                $submission->name = $filename;
                $submission->type = $type;
                $submission->closure_id = $closure->id;
                $submission->faculty_id = $faculty->id;
                $submission->user_id = Auth::id();

                if ($submission->save()){
                    //all done send mail to marketing coordinator and show success

                    //send mail to MCO
                    $to = $faculty->marketingCoordinator->email;
                    $subject = "New submission has been uploaded";
                    $body = "A student of $faculty->name faculty has uploaded a new submission please review the submission by clicking the link below";
                    $link = route("submissionView",$submission->id);
                    $mailer = new Mailer();
                    $mailer->sendMail($to, $subject, $subject, $body,[
                            "link" => $link,
                            "text" => "View Submission"
                        ]);

                    return redirect()->route("allSubmissions")->with("success","The file has been uploaded");
                }
            }else{
                return redirect()->route("allSubmissions")->with("error", " Could not upload, may be a misconfigured server or lack of permissions");
            }




        }else{
            return redirect()->route("allSubmissions")->with("error", " Last date of upload has passed. You are $now->diffInDays($closure_date) days late");
        }
    }
}
