<?php

namespace App\Http\Controllers;

use App\extras\Mailer;
use App\Models\Closure;
use App\Models\Faculty;
use App\Models\Submission;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpWord\IOFactory;
use Spatie\Permission\Models\Role;

class PageController extends Controller
{
    //
    public function manageUsers(){
        return view("pages.manageUsers",[
            "users" => User::all(),
            "roles" => Role::all()
        ]);
    }
    public function submissionView($submission_id)
    {
        //check if the user is the owner or marketing CO
        $submission = Submission::findOrFail($submission_id);

        $roles = Auth::user()->getRoleNames();
        if (
            ($roles->first() == "super-admin" ) ||
            ($roles->first() == "student" && $submission->user_id == Auth::id()) ||
            ($roles->first() == "marketing coordinator" && $submission->faculty_id == Auth::user()->faculty()->id)
        )
        {
            //continue
        }else{
           return redirect()->to("/");
        }

        $filename = $submission->name;
        $file = "uploads/submissions/".$filename;

        if ($submission->type == "document" ){
            $phpword = IOFactory::load($file);
            //generate html
            $phpword->save("data/document.html",'HTML');
        }
        $submissionController = new SubmissionController();
        $status = $submissionController->getSubmissionStatus($submission);

        return view("pages.Submissions.submissionView",[
            'type' => $submission->type,
            'file' => $filename,
            'submission' => $submission,
            "status" => $status
        ]);
    }

    public function allSubmissions( $year = false ){
        if ($year == false){
            $year = date("Y");
        }
        if (strtotime($year) === false) {
            return abort(404);
        }

        //get closure
        $closure = Closure::where("academic_year",$year)->pluck("id");
        $academic_years = Closure::distinct("academic_year")->pluck("academic_year");
        $user = Auth::user();
        $faculties = Faculty::all();
//        dd($user->can('add article and pictures'));
        if ($user->hasRole('super-admin')== false && $user->can('add article and pictures')){ //if a student
//            return "i am student";
            $submissions = Submission::where("user_id", $user->id)->whereIN("closure_id",$closure)->get();
            $faculties = Auth::user()->faculty()->get();
        }else{
            $submissions = Submission::whereIN("closure_id",$closure)->get();
        }
        if ($user->hasRole("marketing coordinator")){
            $his_faculty = Auth::user()->faculty()->first()->id;
            $submissions = Submission::where("faculty_id",$his_faculty)->whereIN("closure_id",$closure)->get();
        }

        return view("pages.Submissions.allSubmissions",[
            "submissions" => $submissions,
            "academic_years" => $academic_years,
            "showing_year" => $year,
            "faculties" => $faculties
        ]);
    }
    public function selectedSubmissions($year = false ){
        if ($year == false){
            $year = date("Y");
        }
        if (strtotime($year) === false) {
            return abort(404);
        }

        //get closure
        $closure = Closure::where("academic_year",$year)->pluck("id");
        $academic_years = Closure::distinct("academic_year")->pluck("academic_year");
        $user = Auth::user();
        if ($user->hasRole('super-admin')== false && $user->can('add articles and pictures')){ //if a student
            $submissions = Submission::where("user_id", $user->id)->where("selected", true)->whereIN("closure_id",$closure)->get();
        }else{
            $submissions = Submission::whereIN("closure_id",$closure)->where("selected", true)->get();
        }

        return view("pages.Submissions.selectedSubmissions",[
            "submissions" => $submissions,
            "academic_years" => $academic_years,
            "showing_year" => $year
        ]);
    }

    public function manageClosures(){
        $closures = Closure::all();
        $faculties = Faculty::all();
        return view("pages.manageClosures",[
            "closures" => $closures,
            "faculties" => $faculties,
        ]);
    }
    public function facultyStudents()
    {
        $faculties = Faculty::all();
        $students = User::role('student')->get();
        return view("pages.facultyStudents",[
            "faculties" => $faculties,
            "students" =>  $students
        ]);
    }
    public function facultyDetails(Faculty $faculty)
    {
        return view("pages.facultyDetails",[
            "faculty" => $faculty
        ]);
    }
    public function allFaculties()
    {
        return view("pages.manageFaculties",[
            "marketing_cos" => User::role('marketing coordinator')->get(),
            "faculties" => Faculty::all()
        ]);
    }
    public function reportView(){
        return view("pages.dashboard");
    }



    //tests
    public function submissionMailTest(){
        //all done send mail to marketing coordinator and show success

        //send mail to MCO
        $to = "safayatjamil27@gmail.com";
        $subject = "New submission has been uploaded";
        $body = "A student of science faculty has uploaded a new submission please review the submission by clicking the link below";
        $link = route("submissionView",1);
        $mailer = new Mailer();
        $mailer->sendMail($to, $subject, $subject, $body,[
            "link" => $link,
            "text" => "View Submission"
        ]);

        return "done";
    }

}
