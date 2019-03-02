<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function addUser(Request $request){

       $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'role' =>['required','numeric'],
        ]);
       $rolename = Role::findById($request->input("role"))->name;
       $statement = User::create([
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'password' => Hash::make($request->input('password')),
           'sector_id' => ($request->has("sector") ? $request->input('sector') : null),
           'output_title_id' => ($request->has("outputTitle") ? $request->input('outputTitle') : null),
       ])->assignRole($rolename);

        if ($statement){
            return redirect()->route("manageUsers")->with("success",$request->input("name")." has been added");
        }else{
            return redirect()->route("manageUsers")->with("error",$request->input("name")." could not be added ");
        }
    }
    public function updateUser(Request $request){
//        return $request->input();
        $validation = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'role' =>['required','numeric'],
        ];
       $updater =[
           'name' => $request->input('name'),
           'email' => $request->input('email'),
           'sector_id' => ($request->has("sector_id") ? $request->input('sector_id') : null),
           'output_title_id' => ($request->has("outputTitle") ? $request->input('outputTitle') : null),
       ];
       if ($request->has("password") && ($request->input("password") != "" || $request->input("password") != null)  ){
           $updater['password'] = Hash::make($request->input('password'));
           $validation['password'] =['string', 'min:3', 'confirmed'];
       }

        $request->validate($validation);

        $rolename = Role::findById($request->input("role"))->name;

       $statement = User::findOrFail($request->input("id"))->update($updater);
        //update role
        User::findOrFail($request->input("id"))->syncRoles([$rolename]);

        if ($statement && User::findOrFail($request->input("id"))->hasRole($rolename)){
            return redirect()->route("manageUsers")->with("success",$request->input("name")." has been Updated");
        }else{
            return redirect()->route("manageUsers")->with("error",$request->input("name")." could not be Updated ");
        }
    }
    public function deleteUser($id){

        if (User::findOrFail($id)->delete()){
            return redirect()->route("manageUsers")->with("success","The User has been deleted");
        }else{
            return redirect()->route("manageUsers")->with("error","The User could not be deleted deleted");
        }
    }

    public function changeRole($user_id, $role){
        $user = User::findOrFail($user_id);
        $rolename = Role::findById($role)->name;
        $user->syncRoles([$rolename]);
        if ($user->hasRole($rolename)){
            return redirect()->route("manageUsers")->with("success",$user->name." is now a ".$rolename);
        }else{
            return redirect()->route("manageUsers")->with("error","Error Occured or ".$user->name." is already ".$rolename);
        }
    }
}
