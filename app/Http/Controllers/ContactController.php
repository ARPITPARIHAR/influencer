<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Create a new Contact instance and assign values directly
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->subject = $request->subject;
        $contact->message = $request->message;

        // Save the contact into the database
        $contact->save();

        // Optionally, you can process further logic here, like sending an email

        // Store the form data in a session for display in the view
        $request->session()->flash('contact_form_data', $request->only(['name', 'subject', 'email', 'message']));

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}
