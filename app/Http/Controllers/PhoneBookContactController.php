<?php

namespace App\Http\Controllers;

use App\Models\PhoneBookContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PhoneBookContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = PhoneBookContact::orderBy('contact_name')->get();
        return response()->json($contacts);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(),[
            'contact_name' => 'required|string|min:5|max:50',
            'contact_number' => 'required|numeric|digits_between:3, 15|unique:phone_book_contacts'
        ], [
            'contact_name.required' => "Contact Name is required",
            'contact_number.required' => "Contact Number is required",
            'contact_number.unique' => "You already have the contact number you provided."
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 400);
        }

        $contact = new PhoneBookContact();
        $contact->contact_name = $request->contact_name;
        $contact->contact_number = $request->contact_number;
        $contact->save();
        return response()->json(['message'=>'Contact Successfully Created'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $phoneBookContact = PhoneBookContact::find($id);
        if(!$phoneBookContact){
            return response()->json(['error'=> "Contact doesn't exist."], 404);
        }
        return response()->json($phoneBookContact);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PhoneBookContact $phoneBookContact)
    {
        return response()->json($phoneBookContact, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'contact_name' =>'required|string|min:5|max:50',
            'contact_number' =>'required|numeric|digits_between:3, 15'
        ], [
            'contact_name.required' => "Contact Name is required",
            'contact_number.required' => "Contact Number is required",
            'contact_number.unique' => "You already have the contact number you provided."
        ]);

        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()],400);
        }
        $phoneBookContact = PhoneBookContact::find($id);
        $phoneBookContact->contact_name = $request->contact_name;
        $phoneBookContact->contact_number = $request->contact_number;
        $phoneBookContact->save();
        return response()->json(['message'=>"Contact Successfully Updated"],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhoneBookContact $phoneBookContact)
    {
        $phoneBookContact->delete();
        return response()->json($phoneBookContact,200);
    }
}
