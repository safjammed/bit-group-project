<?php

namespace App\Http\Controllers;
use App\User;
use Session;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Yajra\DataTables\DataTables;
class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('allfaculty');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation check
        $this->validate($request,[
            'name'=>'required',
            'seats'=>'required|min:1|max:100',
            'user_id'=>'required|numeric',
        ]);

        // store the data into database
        $statement = Faculty::create([
            "name" => $request->input("name"),
            "seats" => $request->input("seats"),
            "user_id" => $request->input("user_id"),
        ]);

        if ($statement){
            return redirect()->route("showFaculties")->with("success",$request->input("name")." has been added");
        }else{
            return redirect()->route("showFaculties")->with("error",$request->input("name")." could not be added ");
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id= $request->input("id");
        $faculty = Faculty::findOrFail($id);
        $faculty->name=$request['name'];
        $faculty->seats=$request['seats'];
        $faculty->user_id=$request['user_id'];
        if ($faculty->save()){
            return redirect()->route("showFaculties")->with("success",$request->input("name")." has been updated");
        }else{
            return redirect()->route("showFaculties")->with("error",$request->input("name")." could not be updated ");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Faculty::destroy($id)){
            return redirect()->route("showFaculties")->with("success","The faculty is no more");
        }else{
            return redirect()->route("showFaculties")->with("error","The faulty is too tough or error. Cuz couldn't delete it");
        }
    }

    //Read all data by json formate
    public function Allfaculty()
    {
        $faculty=Faculty::all();
        return Datatables::of($faculty)
          ->addColumn('action', function($faculty){
            return '<a onclick="showData('.$faculty->id.')" class="btn btn-sm btn-success">Show</a>'.' '. 
            '<a onclick="editForm('.$faculty->id.')" class="btn btn-sm btn-info">Edit</a>'.' '. 
            '<a onclick="deleteData('.$faculty->id.')" class="btn btn-sm btn-danger">Delete</a>';
          })->make(true);
    }

    public function deleteStudent(Faculty $faculty, User $user)
    {
        if($faculty->students()->detach($user->id))
        {
            return redirect()->route("facultyStudents")->withSuccess($user->name." has been removed from ".$faculty->name);
        }else{
            return redirect()->route("facultyStudents")->withInput()->withErrors([$user->name." could not be removed from ".$faculty->name]);
        }
    }
    public function addStudent(Request $request)
    {
        $faculty = Faculty::findOrFail($request->input("faculty_id"));
        $user = User::findOrFail($request->input("user_id"));
        //check if seats are full
        if($faculty->students()->count() < $faculty->seats ){
            if($faculty->students()->attach($user->id))
            {
                return redirect()->route("facultyStudents")->withSuccess($user->name." has been added to ".$faculty->name);
            }else{
//                return redirect()->route("facultyStudents")->withInput()->withErrors([$user->name." could not be added to ".$faculty->name." Faculty Or already added"]);
            }
        }else{
            return redirect()->route("facultyStudents")->withInput()->withErrors([$faculty->name." is already Full!"]);
        }

    }
}
