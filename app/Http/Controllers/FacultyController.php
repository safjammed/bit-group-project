<?php

namespace App\Http\Controllers;
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
            'email'=>'required|email',
            'phone'=>'required|min:11',
            'faculty'=>'required'
        ]);
        $name = $request->name; // $_POST['full_name']
        $email = $request->email;
        $phone = $request->phone;
        $faculty = $request->faculty;

        // store the data into database
        $facul=new Faculty();
        $facul->name=$name;
        $facul->email=$email;
        $facul->phone=$phone;
        $facul->faculty=$faculty;
        $facul->save();
        //dd($message) // for debugging
        Session::flash("success_done","Successfully Data Inserted");
        return redirect()->back();
        
        $data = [
            'name' => $request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'faculty' => $request['faculty']
        ];
        Faculty::create($data);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty=Faculty::find($id);
        return $faculty;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faculty=Faculty::find($id);
        return $faculty;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $faculty = Faculty::find($id);
        $faculty->name=$request['name'];
        $faculty->email=$request['email'];
        $faculty->phone=$request['phone'];
        $faculty->faculty=$request['faculty'];
        $faculty->save();
        return $faculty;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faculty::destroy($id);
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
}
