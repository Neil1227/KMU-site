<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commodity;

class CommodityController extends Controller
{
    // List all commodities
    public function index()
    {
        $commodities = Commodity::select('commodity')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('commodity')
            ->get();

        return view('admin.database.commodities', compact('commodities'));
    }

// Show records for one commodity
public function show($commodity)
{
    $records = Commodity::where('commodity', $commodity)->get();

    $commodities = Commodity::select('commodity')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('commodity')
        ->get();

    return view('admin.database.commodity-table', compact('commodity', 'records', 'commodities'));
}


// Store new commodity
public function store(Request $request)
{
    // Validate first
    $validated = $request->validate([
        'commodity' => 'required|string|max:255',
        'commodity_other' => 'nullable|string|max:255', // allow custom entry
        'thesis_title' => 'required|string|max:500',
        'technologies' => 'nullable|string|max:255',
        'technology_generator' => 'nullable|string|max:255',
        'contact_info' => 'nullable|string|max:100',
        'type_of_technology' => 'nullable|string|max:100',
        'ip_status' => 'nullable|string|max:100',
        'trl_level' => 'nullable|integer|min:1|max:9',
        'sdgs' => 'nullable|string|max:500',
        'remarks' => 'nullable|string|max:255',
        'recommendations' => 'nullable|string|max:500',
        'link' => 'nullable|url|max:500',
        'priority_area' => 'nullable|string|max:255',
    ]);

    // If "other" is selected, use the text field instead
    if ($validated['commodity'] === 'other') {
        $validated['commodity'] = $request->input('commodity_other');
    }

    $commodity = Commodity::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Commodity record added successfully!',
        'data' => $commodity
    ]);
}

 public function update(Request $request, $id)
{
    $validated = $request->validate([
        'commodity' => 'required|string|max:255',
        'commodity_other' => 'nullable|string|max:255', // allow new entry
        'thesis_title' => 'required|string|max:500',
        'technologies' => 'nullable|string|max:255',
        'technology_generator' => 'nullable|string|max:255',
        'contact_info' => 'nullable|string|max:100',
        'type_of_technology' => 'nullable|string|max:100',
        'ip_status' => 'nullable|string|max:100',
        'trl_level' => 'nullable|integer|min:1|max:9',
        'sdgs' => 'nullable|string|max:500',
        'remarks' => 'nullable|string|max:255',
        'recommendations' => 'nullable|string|max:500',
        'link' => 'nullable|string|max:500', // ✅ fixed here
        'priority_area' => 'nullable|string|max:255',
    ]);

    // Handle "New Commodity" case
    if ($validated['commodity'] === 'other') {
        $validated['commodity'] = $request->input('commodity_other');
    }

    $commodity = Commodity::findOrFail($id);
    $commodity->update($validated);

    return response()->json([
        'success' => true,
        'message' => 'Commodity record updated successfully!',
        'data' => $commodity
    ]);
}


    public function destroy($id)
    {
        try {
            $record = Commodity::findOrFail($id);
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete record.'
            ], 500);
        }
    }

}
