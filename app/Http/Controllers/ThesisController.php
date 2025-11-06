<?php

namespace App\Http\Controllers;

use App\Models\Research;
use App\Models\Kmu_Thesis;
use Illuminate\Http\Request;

class ThesisController extends Controller
{
    /**
     * Display a listing of all research entries (KMU + Others).
     */
    public function index()
    {
        // Fetch all KMU and non-KMU research records
        $kmuResearches = Kmu_Thesis::all();
        $otherResearches = Research::all();

        // Merge both collections
        $researches = $kmuResearches->concat($otherResearches)->sortByDesc('created_at');

        // ✅ Mark all pending Research records as active (after fetching)
        Research::where('status', 'pending')->update(['status' => 'active']);

        return view('admin.new-research', compact('researches'));
    }
    // for acknowledging notification
    public function acknowledge($id)
    {
        $research = Research::find($id);

        if (!$research) {
            return response()->json(['success' => false, 'message' => 'Research not found.']);
        }

        if ($research->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'This research is already acknowledged.']);
        }

        $research->update(['status' => 'active']);

        return response()->json(['success' => true, 'message' => 'Research acknowledged successfully.']);
    }


    /**
     * Display the Add Thesis page.
     */
    public function addThesis()
    {
        $researches = Research::all();
        return view('admin.add-thesis', compact('researches'));
    }

    /**
     * Store a new research record under KMU.
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
            Research::create($request->only([
                'title',
                'authors',
                'technology_type',
                'priority_area',
                'link'
            ]));

            return redirect()->back()->with('success', 'Research added successfully yes!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add research. Please try again.');
        }
    }



    /**
     * Delete either a Research or KMU_Thesis record.
     */
    public function destroy($id)
    {
        try {
            // Try to find the record in either table
            $record = Research::find($id) ?? Kmu_Thesis::find($id);

            if (!$record) {
                return response()->json([
                    'success' => false,
                    'message' => 'Record not found.',
                ], 404);
            }

            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete record. Please try again.',
            ], 500);
        }
    }
}
