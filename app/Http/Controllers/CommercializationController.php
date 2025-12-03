<?php

namespace App\Http\Controllers;

use App\Models\Commercialization;
use App\Models\Commodity;
use Illuminate\Http\Request;

class CommercializationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $commercializations = Commercialization::with('commodity')->latest()->paginate(10);

        return view('admin.iptbm.index', compact('commercializations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'commodity_id' => 'required|exists:commodities,id',
            'thesis_title' => 'nullable|string|max:255',
            'technologies' => 'nullable|string',
            'technology_generator' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'type_of_technology' => 'nullable|string|max:255',
            'ip_status' => 'nullable|string|max:255',
            'trl_level' => 'nullable|string|max:255',
            'sdgs' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'link' => 'nullable|string|max:255',
            'priority_area' => 'nullable|string|max:255',
        ]);

        Commercialization::create($request->all());

        return redirect()->route('commercialization.index')
            ->with('success', 'Commercialization record created successfully.');
    }

    public function destroy($id)
    {
        try {
            $commercialization = Commercialization::findOrFail($id);
            $commercialization->delete();

            return response()->json([
                'success' => true,
                'message' => 'Commercialization record deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete the record.'
            ], 500);
        }
    }


    public function pushFromCommodity($id)
    {
        try {
            $commodity = Commodity::findOrFail($id);

            Commercialization::create([
                'commodity_id' => $commodity->id,
                'commodity' => $commodity->commodity,
                'thesis_title' => $commodity->thesis_title,
                'technologies' => $commodity->technologies,
                'technology_generator' => $commodity->technology_generator,
                'contact_info' => $commodity->contact_info,
                'type_of_technology' => $commodity->type_of_technology,
                'ip_status' => $commodity->ip_status,
                'trl_level' => $commodity->trl_level,
                'sdgs' => $commodity->sdgs,
                'remarks' => $commodity->remarks,
                'recommendations' => $commodity->recommendations,
                'link' => $commodity->link,
                'priority_area' => $commodity->priority_area,
            ]);

            return response()->json(['message' => 'Pushed to Commercialization successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to push this record.'], 500);
        }
    }
}
