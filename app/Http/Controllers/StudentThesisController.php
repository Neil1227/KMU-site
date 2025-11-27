<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thesis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class StudentThesisController extends Controller
{
    public function show($id)
{
    $thesis = Thesis::findOrFail($id); // Make sure to use your Thesis model
    return response()->json($thesis);
}

    public function index()
    {
        $theses = Thesis::all();
        return view('admin.student_research.thesis-papers', compact('theses'));
    }

    public function form()
    {
        return view('thesis.form');
    }

    public function submit(Request $request)
    {
        $request->validate([
            'email'            => 'required|email|unique:theses,email',
            'fullname'         => 'required|string|max:255',
            'psau_id'          => 'required|string|max:50|unique:theses,psau_id',
            'contact_number'   => 'required|string|max:50',
            'graduate_student' => 'required|boolean',
            'googledrive_link' => 'nullable|url',
            'college'          => 'nullable|string|max:255',
            'program'          => 'nullable|string|max:255',
            'thesis_title'     => 'required|string|max:255|unique:theses,thesis_title',
            'adviser'          => 'nullable|string|max:255',
            'groupmates'       => 'nullable|string',
            'graduation_month' => 'nullable|integer|min:1|max:12',
            'graduation_year'  => 'nullable|integer|min:1900|max:2100',
            'thesis_file'      => 'required|mimes:pdf|max:10240',
        ]);

        $filePath = $request->file('thesis_file')->store('theses', 'public');

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
            'graduation_month' => $request->graduation_month,
            'graduation_year'  => $request->graduation_year,
            'file_path'        => $filePath,
        ]);

        return redirect()->route('thesis.form')->with('success', 'Thesis submitted successfully!');
    }

    // Update
    public function update(Request $request, Thesis $thesis)
    {
        $request->validate([
            'email'            => ['required','email',Rule::unique('theses')->ignore($thesis->id)],
            'fullname'         => 'required|string|max:255',
            'psau_id'          => ['required','string','max:50',Rule::unique('theses')->ignore($thesis->id)],
            'contact_number'   => 'required|string|max:50',
            'graduate_student' => 'required|boolean',
            'googledrive_link' => 'nullable|url',
            'college'          => 'nullable|string|max:255',
            'program'          => 'nullable|string|max:255',
            'thesis_title'     => ['required','string','max:255',Rule::unique('theses')->ignore($thesis->id)],
            'adviser'          => 'nullable|string|max:255',
            'groupmates'       => 'nullable|string',
            'graduation_month' => 'nullable|integer|min:1|max:12',
            'graduation_year'  => 'nullable|integer|min:1900|max:2100',
            'thesis_file'      => 'nullable|mimes:pdf|max:10240',
        ]);

        if ($request->hasFile('thesis_file')) {
            // Delete old file
            if ($thesis->file_path) {
                Storage::disk('public')->delete($thesis->file_path);
            }
            $thesis->file_path = $request->file('thesis_file')->store('theses', 'public');
        }

        $thesis->update($request->only([
            'email','fullname','psau_id','contact_number','graduate_student',
            'googledrive_link','college','program','thesis_title','adviser',
            'groupmates','graduation_month','graduation_year'
        ]));

        return redirect()->back()->with('success','Thesis updated successfully!');
    }

    // Delete
    public function destroy(Thesis $thesis)
    {
        if ($thesis->file_path) {
            Storage::disk('public')->delete($thesis->file_path);
        }

        $thesis->delete();
        return response()->json(['success' => true]);
    }
}
