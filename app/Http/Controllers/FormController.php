<?php

namespace App\Http\Controllers;

use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{

public function store(Request $request)
{

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
    $newContentType = $request->input('newContentType');
    if (!empty($newContentType)) {

        if ($newContentType !== 'Add another content type') {
            $contentTypes[] = $newContentType;
        }
    }

    $contentTypes = array_filter($contentTypes, function ($type) {
        return $type !== 'Add another content type';
    });

    $form->content_types = implode(',', $contentTypes);

    if ($request->hasFile('image')) {
        $fileName = time() . '-slider-' . $request->file('image')->getClientOriginalName();
        $filePath = $request->file('image')->storeAs('uploads/images', $fileName, 'public');
        $form->thumbnail_img = '/public/storage/' . $filePath;
    }


    $form->save();

    return redirect()->back()->with('success', 'Form submitted successfully!');
}


public function show()
{
    $formData = Form::all();
    return view('user.show', ['formData' => $formData]);
}


}
