<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
