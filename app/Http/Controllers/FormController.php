<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

public function store(Request $request)
{
    // Dump and die to view all request data
    //  dd($request->all());

    // Create a new form entry
    $form = new Form();

    $form->first_name = $request->input('firstName');
    $form->last_name = $request->input('lastName');
    $form->email = $request->input('email');
    $form->contact_number = $request->input('contactNumber');

    $socialMedia = [];
    foreach ($request->input('social_media', []) as $key) {
        $socialMedia[$key] = $request->input("{$key}_handle");
    }
    $form->social_media = json_encode($socialMedia);
    $contentTypes = $request->input('contentTypes', []);
    $form->content_types = implode(',', $contentTypes);
    // Handle file upload if present

    if ($request->hasFile('image')) {
        $fileName = time() . '-slider-' . $request->file('image')->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads/images', $fileName, 'public');
        $form->thumbnail_img = '/public/storage/' . $filePath;
    }
    
    // Save the form data
    $form->save();

    // Redirect with a success message
    return redirect()->back()->with('success', 'Form submitted successfully!');
}

}
