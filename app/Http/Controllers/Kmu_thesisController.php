<?php

namespace App\Http\Controllers;

use App\Models\Kmu_Thesis;
use App\Models\Research;
use Illuminate\Http\Request;

class Kmu_thesisController extends Controller
{
    /**
     * Display all KMU theses.
     */
public function index()
{
    // Fetch Research and add a dynamic property
    $researches = Research::all()->map(function ($item) {
        $item->source = 'Research'; // dynamic property
        return $item;
    });

    // Fetch KMU Theses and add dynamic property
    $kmuTheses = Kmu_Thesis::all()->map(function ($item) {
        $item->source = 'KMU Thesis'; // dynamic property
        return $item;
    });

    // Merge both collections
    $allResearches = $researches->concat($kmuTheses);

    // Total count
    $totalCount = $allResearches->count();

    return view('admin.new-research', [
        'researches' => $allResearches,
        'totalCount' => $totalCount
    ]);
}



    /**
     * Store a new research record into the general Research table.
     */
    public function storetokmu(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'authors' => 'required|string|max:255',
            'technology_type' => 'required|string|max:255',
            'priority_area' => 'required|string|max:255',
            'link' => 'nullable|url',
        ]);

        try {
            Kmu_Thesis::create($request->only([
                'title', 'authors', 'technology_type', 'priority_area', 'link'
            ]));

            return redirect()->back()->with('success', 'Research added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add research. Please try again.');
        }
    }
}

