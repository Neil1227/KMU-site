<?php

namespace App\Http\Controllers;

use App\Models\Research;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    /**
     * Display a listing of the research entries.
     */
public function index()
{
    // Fetch all research data
    $researches = Research::all();

    // Count pending research (optional — you can count all if no status column)
    $newResearchCount = Research::where('status', 'pending')->count();

    // Pass both to the view
    return view('admin.new-research', compact('researches', 'newResearchCount'));
}

public function addThesis()
{
    // Fetch all existing research records
    $researches = Research::all();

    // Optional: count for sidebar badge or notifications
    $newResearchCount = Research::count();

    // Load the add-thesis view with both variables
    return view('admin.add-thesis', compact('researches', 'newResearchCount'));
}

    /**
     * Show the form for creating a new research entry.
     */
public function create()
{
    $newResearchCount = Research::count();

    return view('admin.add-thesis', compact('newResearchCount'));
}


    /**
     * Store a newly created research in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'technology_type' => 'required|string|max:255',
            'priority_area' => 'required|string|max:255',
            'link' => 'nullable|url',
        ]);

        try {
            Research::create([
                'title' => $request->title,
                'authors' => $request->authors,
                'technology_type' => $request->technology_type,
                'priority_area' => $request->priority_area,
                'link' => $request->link,
            ]);

            return redirect()->back()->with('success', 'Research added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add research. Please try again.');
        }
    }

    /**
     * Display the specified research.
     */
    public function show(Research $research)
    {
        return view('research.show', compact('research'));
    }

    /**
     * Show the form for editing the specified research.
     */
    public function edit(Research $research)
    {
        return view('research.edit', compact('research'));
    }

    /**
     * Update the specified research in storage.
     */
    public function update(Request $request, Research $research)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string',
            'technology_type' => 'required|string|max:255',
            'link' => 'nullable|url',
            'priority_area' => 'required|string|max:255',
        ]);

        $research->update($validated);

        return redirect()->route('research.index')->with('success', 'Research updated successfully!');
    }

    /**
     * Remove the specified research from storage.
     */
public function destroy($id)
{
    $research = Research::find($id);

    if (!$research) {
        return response()->json([
            'success' => false,
            'message' => 'Research not found.'
        ], 404);
    }

    $research->delete();

    return response()->json([
        'success' => true,
        'message' => 'Research successfully deleted!'
    ]);
}

}
