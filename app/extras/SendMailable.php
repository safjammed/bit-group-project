<?php
/**
 * Created by PhpStorm.
 * User: safja
 * Date: 3/20/2019
 * Time: 1:14 AM
 */

namespace App\extras;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $title;
    public $body;
    public $cta;

    public function  __construct($subject = "Mail From ScriptLauncher", $title = "Mail From ScriptLauncher", $body = "Hi There!", $cta= ["link" => "/","text"=>"Go Home"])
    {
        $this->subject = $subject;
        $this->title = $title;
        $this->body = $body;
        $this->cta= $cta;
    }

    public function build()
    {
        return $this->view("mail.defaultMail");
    }
}