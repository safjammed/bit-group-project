<?php

namespace App\Http\Controllers;

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

    public function allSubmissions(){
        $user = Auth::user();
        if ($user->hasRole('super-admin')== false && $user->hasPermissionTo('add articles and pictures')){ //if a student
            $submissions = Submission::where("user_id", $user->id);
        }else{
            $submissions = Submission::all();
        }

        return view("pages.Submissions.allSubmissions",[
            "submissions" => $submissions
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
}
