<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function addUser(Request $request){
//        return $request->input();
        //make phone
        $phone = $request->input("phone");
        $phone_withintl= $request->input("phone_withintl");
        $countryCode = str_replace($phone,"",$phone_withintl);
        if ($request->input('country_code') != ""){
            $countryCode =$request->input('country_code');
            $phone = str_replace($countryCode,"", $phone_withintl);
        }
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'phone' => ['unique:users'],
            'two_factor' => ['required'],
            'role' =>['required','numeric'],
        ]);
        $rolename = Role::findById($request->input("role"))->name;
        $statement = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $phone,
            'country_code' => $countryCode,
            'two_factor' => ($request->input('two_factor') == "0" ? false : true),
            'password' => Hash::make($request->input('password')),
            "email_verified_at" => Carbon::now()
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
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'two_factor' => ['required'],
            'role' =>['required','numeric'],
        ];

        //make phone
        $phone = $request->input("phone");
        $phone_withintl= $request->input("phone_withintl");
        $countryCode = str_replace($phone,"",$phone_withintl);
        if ($request->input('country_code') != ""){
            $countryCode =$request->input('country_code');
            $phone = str_replace($countryCode,"", $phone_withintl);
        }

        $updater =[
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $phone,
            'country_code' => $countryCode,
            'two_factor' => $request->input('two_factor'),
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

    public function updatePermission(Request $request)
    {
        if (! $request->has(["user_id", "permissions"]) ){
            return redirect()->route("manageUsers")->withInput()->with("error","Hey! No user to give permission to 😒");
        }

        $permissions = $request->input("permissions");
        $user = User::findOrFail($request->input("user_id"));

        if ($user->syncPermissions($permissions)){
            return redirect()->route("manageUsers")->with("success", "Changed the permissions of ".$user->name." ");
        }else{
            return redirect()->route("manageUsers")->with("error","Error Occured or ".$user->name." already has the permissions");
        }



    }
}
