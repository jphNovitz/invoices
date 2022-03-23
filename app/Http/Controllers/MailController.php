<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;

class MailController extends Controller
{
    public function basic_email()
    {
        $data = array('name' => "Lipsum");

//        Mail::send('mail',['name','Ripon Uddin Arman'],function($message){
//            $message->to('rislam252@gmail.com')->subject("Email Testing with Laravel");
//            $message->from('clhg52@gmail.com','Creative Losser Hopeless Genius');
//        });

        Mail::send(['text' => 'mail'], $data, function ($message) {
            $message->to('abc@gmail.com', 'Lorem')->subject
            ('Laravel Basic Testing Mail');
            $message->from('xyz@gmail.com', 'lorem ');
        });
        echo "Basic Email Sent. Check your inbox.";
    }
//
//    public function html_email()
//    {
//        $data = array('name' => "Lorem Ipsum");
//        Mail::send('mail', $data, function ($message) {
//            $message->to('abc@gmail.com', 'lrem ')->subject
//            ('Laravel HTML Testing Mail');
//            $message->from('xyz@gmail.com', 'lorem');
//        });
//        echo "HTML Email Sent. Check your inbox.";
//    }
//
//    public function attachment_email()
//    {
//        $data = array('name' => "Lorem");
//        Mail::send('mail', $data, function ($message) {
//            $message->to('abc@gmail.com', 'Lorem')->subject
//            ('Laravel Testing Mail with Attachment');
//            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//            $message->from('xyz@gmail.com', 'Lorem');
//        });
//        echo "Email Sent with attachment. Check your inbox.";
//    }
}