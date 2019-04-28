<?php

namespace App\Http\Controllers;

use App\Models\Closure;
use Illuminate\Http\Request;

class ClosureController extends Controller
{
    public function addUpdateClosure(Request $request){
        $academic_year = date("Y");
        $statement = Closure::updateOrCreate([
            "academic_year" => $academic_year,
            "faculty_id" => $request->input("faculty_id")
        ],[
            "closure" => $request->input("closure"),
            "final_closure" => $request->input("final_closure")
        ]);
        if ($statement){
            return redirect()->route("manageClosures")->with("success","The info has been saved");
        }else{
            return redirect()->route("manageClosures")->with("error"," The info could not be saved ");
        }
    }
}
