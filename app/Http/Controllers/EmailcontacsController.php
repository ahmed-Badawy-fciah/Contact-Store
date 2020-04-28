<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailcontacsController extends Controller
{
    public function show()
    {
        return view('emails.show');
    }

    public function store()
    {
        request()->validate(['email' => 'required|email']);
        
        Mail::raw('It Works' , function($message){
            $message->to(request('email'))
            ->subject('Hello Message!');
        });
        return redirect('/emailcontact')
        ->with('message' , 'Email sent to ' . request('email') . ' Successfully!');
    }
}
