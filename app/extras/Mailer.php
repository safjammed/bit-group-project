<?php

namespace App\extras;


use Illuminate\Support\Facades\Mail;

class Mailer
{
    public $from = "test.safjammed@gmail.com";
    public $from_name = "Script Launcher";

    public function sendMail( $to = "test.safjammed@gmail.com", $subject = "Mail From ScriptLauncher", $title = "Mail From ScriptLauncher", $body = "Hi There!",$cta= ["link" => "/","text"=>"Go Home"] ){
        try{
            Mail::to($to)->send(new SendMailable($subject,$title,$body,$cta));
            return true;
        }catch (\Exception $e){
            return false;
        }
    }
}