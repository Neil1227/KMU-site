<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use Illuminate\Http\Request; // your model
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function allRecords()
    {
        // Get all records
        $records = Commodity::all();

        // Get distinct commodities with their counts
        $commodities = Commodity::select('commodity', DB::raw('COUNT(*) as total'))
            ->groupBy('commodity')
            ->get();

        return view('admin.database.records', compact('records', 'commodities'));
    }

    // Update record
    public function updateRecord(Request $request, $id)
    {
        $record = Commodity::findOrFail($id);

        $validated = $request->validate([
            'commodity' => 'required|string|max:255',
            'commodity_other' => 'nullable|string|max:255',
            'technology_generator' => 'nullable|string|max:255',
            'thesis_title' => 'required|string|max:255',
            'technologies' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'type_of_technology' => 'nullable|string|max:255',
            'ip_status' => 'nullable|string|max:255',
            'trl_level' => 'nullable|string|max:5',
            'sdgs' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
            'recommendations' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'priority_area' => 'nullable|string|max:255',
        ]);

        // Handle "other" commodity input
        if ($validated['commodity'] === 'other' && ! empty($validated['commodity_other'])) {
            $record->commodity = $validated['commodity_other'];
        } else {
            $record->commodity = $validated['commodity'];
        }

        $record->technology_generator = $validated['technology_generator'] ?? null;
        $record->thesis_title = $validated['thesis_title'];
        $record->technologies = $validated['technologies'] ?? null;
        $record->contact_info = $validated['contact_info'] ?? null;
        $record->type_of_technology = $validated['type_of_technology'] ?? null;
        $record->ip_status = $validated['ip_status'] ?? null;
        $record->trl_level = $validated['trl_level'] ?? null;
        $record->sdgs = $validated['sdgs'] ?? null;
        $record->remarks = $validated['remarks'] ?? null;
        $record->recommendations = $validated['recommendations'] ?? null;
        $record->link = $validated['link'] ?? null;
        $record->priority_area = $validated['priority_area'] ?? null;

        $record->save();

        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully!',
        ]);
    }
}
