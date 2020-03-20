<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\RFCValidation;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = Contact::all();
        return compact('collection');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'      => 'required|min:5',
            'email'     => 'required|unique:contacts,email|email:rfc,dns|',
            'contact'   => 'required|digits:9'
        ]);

        // Email advanced validator
        // $validator = new EmailValidator();
        // $validator->isValid("example@example.com", new RFCValidation());

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();     
        }

        $collection = Contact::create($collection);

        return compact('collection');
    }

    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return View
     */
    public function show($id)
    {
        $collection = Contact::findOrFail($id);
        return compact('collection');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name'      => 'required|min:5',
            'email'     => 'required|unique:contacts,email|email:rfc,dns|',
            'contact'   => 'required|digits:9'
        ]);

        // Email advanced validator
        // $validator = new EmailValidator();
        // $validator->isValid("example@example.com", new RFCValidation());

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();     
        }

        $contact = Contact::find($id);
        $contact->update($data);

        return compact('contact');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::find($id);
        return $contact->delete();
    }
}
