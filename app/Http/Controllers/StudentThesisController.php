<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thesis;

class StudentThesisController extends Controller
{
    /**
     * Show the thesis submission form
     */
    public function form()
    {
        return view('thesis.form'); // Adjust to your Blade view
    }

    /**
     * Submit full thesis form → Save to database
     */
public function submit(Request $request)
{
    $request->validate([
        // User info
        'email'            => 'required|email|unique:theses,email',
        'fullname'         => 'required|string|max:255',
        'psau_id'          => 'required|string|max:50|unique:theses,psau_id',
        'contact_number'   => 'required|string|max:50',
        'graduate_student' => 'required|boolean',
        'googledrive_link' => 'nullable|url',

        // Thesis info
        'college'         => 'nullable|string|max:255',
        'program'         => 'nullable|string|max:255',
        'thesis_title'    => 'required|string|max:255|unique:theses,thesis_title',
        'adviser'         => 'nullable|string|max:255',
        'groupmates'      => 'nullable|string',
        'graduation_year' => 'nullable|integer|min:1900|max:2100',

        // Uploaded file
        'thesis_file'     => 'required|mimes:pdf|max:10240',
    ], [
        'email.unique'        => 'This email has already been used.',
        'psau_id.unique'      => 'This PSAU ID has already been submitted.',
        'thesis_title.unique' => 'A thesis with this title already exists.',
    ]);

    // Store uploaded file
    $filePath = $request->file('thesis_file')->store('theses', 'public');

    // Save to database
    Thesis::create([
        'email'            => $request->email,
        'fullname'         => $request->fullname,
        'psau_id'          => $request->psau_id,
        'contact_number'   => $request->contact_number,
        'graduate_student' => $request->graduate_student,
        'googledrive_link' => $request->googledrive_link,

        'college'          => $request->college,
        'program'          => $request->program,
        'thesis_title'     => $request->thesis_title,
        'adviser'          => $request->adviser,
        'groupmates'       => $request->groupmates,
        'graduation_year'  => $request->graduation_year,

        'file_path'        => $filePath,
    ]);

    return redirect()
        ->route('thesis.form')
        ->with('success', 'Thesis submitted successfully!');
}

}
