<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;


class ApiController extends Controller
{
    public function geoLocation(Request $request){
        $ip = $request->input("ip");
        return trim(file_get_contents("https://ipinfo.io/".$ip."/geo"));
    }
    public function loadDocument(){
        return file_get_contents("data/document.html");
    }
    public function loadPicture($file){
        return file_get_contents("uploads/submissions/".$file);
    }
    public function homeReports(){
        //progress bars
        $output = (object)[];
        $output->submission_total = Submission::all()->count();
        $output->faculty_total = (object)[] ;
        foreach (Faculty::all() as $index => $faculty){
            $output->faculty_total->{$faculty->name} = $faculty->submissions->count();
        }
        return Response::json($output);
    }
}
