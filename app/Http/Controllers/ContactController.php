<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use Validator;

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
        return view('home', compact('collection'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('template.create');
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
            'contact'   => 'required|min:9|max:9',
            'email'     => 'required|unique:contacts,email|email:rfc,dns',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();     
        }

        $collection = Contact::create($data);
        $message = 'Contact created!';

        return view('template.edit', compact('collection', 'message'));
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
        return view('template.show', compact('collection'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $collection = Contact::findOrFail($id);
        return view('template.edit', compact('collection'));
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
            'contact'   => 'required|min:9|max:9',
            'email'     => 'required|email:rfc,dns|unique:contacts,email,'.$id,
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();     
        }

        $collection = Contact::find($id);
        $collection->update($data);

        $message = 'Contact updated!';

        return view('template.edit', compact('collection', 'message'));
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
        $contact->delete();
        
    }
}
