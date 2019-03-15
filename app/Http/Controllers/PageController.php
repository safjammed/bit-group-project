<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use App\User;
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

        $roles =(array) Auth::user()->getRoleNames();

//        dd($roles);
        if (
            in_array("super-admin", $roles)||
            in_array("marketing coordinator", $roles) ||
            (in_array("student", $roles) && $submission->user_id == Auth::user()->id)
        )
        {
            //continue
        }else{
            redirect()->route("home");
        }

        $filename = $submission->name;
        $file = "uploads/submissions/".$filename;

        if ($submission->type == "document" ){
            $phpword = IOFactory::load($file);
            //generate html
            $phpword->save("data/document.html",'HTML');
        }


        return view("pages.submissionView",[
            'type' => $submission->type,
            'file' => $filename,
            'submission' => $submission
        ]);
    }
}
