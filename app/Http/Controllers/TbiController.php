<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tbi;
use Illuminate\Http\Request;

class TbiController extends Controller
{
    public function index()
    {
        $tbiRecords = Tbi::latest()->get();
        return view('admin.tbi.index', compact('tbiRecords'));
    }

    public function store(Request $request)
    {
        Tbi::create([
            'thesis_title' => $request->thesis_title,
            'technologies' => $request->technologies,
            'technology_generator' => $request->technology_generator,
            'type_of_technology' => $request->type_of_technology,
            'contact_info' => $request->contact_info,
            'remarks' => $request->remarks,
            'link' => $request->link,
        ]);

        return redirect()->back()->with('success', 'Record successfully pushed to TBI!');
    }


    public function update(Request $request, $id)
    {
        $tbi = Tbi::findOrFail($id);
        $tbi->update($request->all());

        return redirect()->back()->with('success', 'TBI record updated successfully.');
    }

    public function destroy($id)
    {
        $tbi = Tbi::findOrFail($id);
        $tbi->delete();

        return response()->json([
            'success' => true,
            'message' => 'Record deleted successfully.'
        ]);
    }
}
