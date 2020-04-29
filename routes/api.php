<?php

use Illuminate\Http\Request;
use App\Contact;

Route::group(['middleware' => 'api'] , function(){
    // get all contacts
    Route::get('contacts' , 'ContactsController@index');
    
    // get a spacific contact
    Route::get('contact/{id}', 'ContactsController@show');

    //Create Contact
    Route::post('contact/store' , 'ContactsController@store');

    //Update Contact
    Route::patch('contact/{id}' , 'ContactsController@update');

    //Delete Contact
    Route::delete('contact/{id}','ContactsController@destroy');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
