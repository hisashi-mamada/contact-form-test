<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function index()
    {
        return view('index');
    }
    public function confirm(ContactRequest $request)
    {
        $contact = $request->all();
        return view('confirm', compact('contact'));
    }
    public function store(ContactRequest $request)
    {
        $contact = $request->only(['last_name', 'first_name', 'gender', 'email', 'address', 'building', 'category_id', 'detail']);

        $contact['phone'] = $request->phone1 . '-' . $request->phone2 . '-' . $request->phone3;


        Contact::create($contact);

        return view('thanks');
    }
}
