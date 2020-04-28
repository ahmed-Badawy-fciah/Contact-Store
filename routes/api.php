<?php

use Illuminate\Http\Request;
use App\Contact;

Route::group(['middleware' => 'api'] , function(){
    // get all contacts
    Route::get('contacts',function(){
        return Contact::all();
    });
    
    // get a spacific contact
    Route::get('contact/{id}', function($id){
        return Contact::findOrFail($id);
    });

    //Create Contact
    Route::post('contact/store' , function(Request $request){
        return Contact::create([
        'name' => $request->input(['name']),
        'email' => $request->input(['email']),
        'phone' => $request->input(['phone'])
        ]);
    });

    //Update Contact
    Route::patch('contact/{id}' , function(Request $request , $id){
        return Contact::findOrFail($id)->update(['name' => $request->input(['name']),
        'email' => $request->input(['email']),
        'phone' => $request->input(['phone'])
        ]);
    });

    //Delete Contact
    Route::delete('contact/{id}',function($id){
        return Contact::destroy($id);
    });
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
