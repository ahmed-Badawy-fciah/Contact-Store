<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;
class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('name')->get();
        return $contacts ;
    }
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return $contact;
    }

    public function store(Request $request)
    {
        $contact = new Contact ;
        $this->save($request , $contact);
    }

    public function update(Request $request , $id)
    {
        $contact =  Contact::findOrFail($id) ;
        $this->save($request , $contact);
    }

    public function destroy($id)
    {
        $contact =  Contact::findOrFail($id) ;
        $contact->delete();
    }

    private function save(Request $request , Contact $contact)
    {
        $this->ValidateContact($contact->id);
        $contact->name = $request->input(['name']);      
        $contact->email = $request->input(['email']);
        $contact->phone = $request->input(['phone']);
        $contact->save();
    }
    private function ValidateContact($id){
        request()->validate([
            'name' => 'required',
            'email' => 'required|unique:contacts,email,' . $id ,
            'phone' => 'required|regex:/(01)[0-9]{9}/'
        ]);
    }
}
