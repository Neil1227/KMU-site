<?php

namespace App\Http\Controllers;

use App\Models\Kmu_Thesis;
use App\Models\Research;
use App\Models\Commodity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Kmu_thesisController extends Controller
{
    /**
     * Display all KMU theses.
     */
    public function index()
    {
        // Fetch Research and add dynamic property
        $researches = Research::all()->map(function ($item) {
            $item->source = 'Research';
            return $item;
        });

        // Fetch KMU Theses and add dynamic property
        $kmuTheses = Kmu_Thesis::all()->map(function ($item) {
            $item->source = 'KMU Thesis';
            return $item;
        });

        $commodities = Commodity::select('commodity', DB::raw('COUNT(*) as total'))
            ->groupBy('commodity')
            ->get();

        // Merge both collections
        $allResearches = $researches->concat($kmuTheses);

        return view('admin.new-research', [
            'researches' => $allResearches,
            'totalCount' => $allResearches->count(),
            'commodities' => $commodities
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
                'title',
                'authors',
                'technology_type',
                'priority_area',
                'link'
            ]));

            return redirect()->back()->with('success', 'Research added successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to add research. Please try again.');
        }
    }

    public function pushToIptbm(Request $request)
    {
        // 1️⃣ Validate input
        $validated = $request->validate([
            'commodity' => 'required|string|max:255',
            'commodity_other' => 'nullable|string|max:255',
            'thesis_title' => 'required|string|max:255',
            'technology_generator' => 'required|string|max:255',
            'type_of_technology' => 'required|string|max:255',
            'priority_area' => 'required|string|max:255',
            'ip_status' => 'required|string|max:255',
            'trl_level' => 'required|string|max:255',
            'remarks' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        // 2️⃣ Use “other” text if selected
        $commodity = $request->commodity === 'other'
            ? $request->commodity_other
            : $request->commodity;

        // 3️⃣ Prevent duplicate records
        $exists = Commodity::where('thesis_title', $validated['thesis_title'])
            ->where('technology_generator', $validated['technology_generator'])
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This record already exists in the IPTBM database.'
            ]);
        }

        // 4️⃣ Create new record
        Commodity::create([
            'commodity' => $commodity,
            'thesis_title' => $validated['thesis_title'],
            'technologies' => $request->technologies ?? null,
            'technology_generator' => $validated['technology_generator'],
            'contact_info' => $request->contact_info ?? null,
            'type_of_technology' => $validated['type_of_technology'],
            'ip_status' => $validated['ip_status'],
            'trl_level' => $validated['trl_level'],
            'sdgs' => $request->sdgs ?? null,
            'remarks' => $validated['remarks'] ?? null,
            'recommendations' => $request->recommendations ?? null,
            'link' => $validated['link'] ?? null,
            'priority_area' => $validated['priority_area'],
        ]);

        // 5️⃣ Return success message
        return response()->json([
            'success' => true,
            'message' => 'Successfully pushed to the IPTBM database!'
        ]);
    }
}
