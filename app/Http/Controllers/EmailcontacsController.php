<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Contact as ContactInfo ;
use App\Mail\Contact;
use App\Mail\ContactMe;
class EmailcontacsController extends Controller
{
    public function show()
    {
        return view('emails.show' , 
    ['contacs' => ContactInfo::all()]);
    }

    public function store()
    {
        request()->validate(['email' => 'required|email']);
        
        // Mail::raw('It Works' , function($message){
        //     $message->to(request('email'))
        //     ->subject('Hello Message!');
        // });

        Mail::to(request('email'))
        ->send(new Contact());

        return redirect('/emailcontact')
        ->with('message' , 'Email sent to ' . request('email') . ' Successfully!');
    }
}
