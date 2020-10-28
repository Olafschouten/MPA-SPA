<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function show()
    {
        return view('email.email');
    }

    public function sendEmail(Request $request) {
        print_r($request->input('title'));
        print_r($request->input('message'));
        die();


        Mail::send('email.email', $request, function($message){
            $message->to('olafschouten99@gmail.com', 'Olaf')->subject($request->input('message'));
        });
    }
}
