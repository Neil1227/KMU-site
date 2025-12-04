<?php

namespace App\Http\Controllers;

use App\Models\AgriBusiness;
use App\Models\Commercialization;
use Illuminate\Http\Request;

class AgriBusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $agriBusinesses = AgriBusiness::latest()->paginate(10);
        $newAgriBusinessCount = AgriBusiness::count(); // or count of "new" records
        return view('admin.agribus.index', compact('agriBusinesses', 'newAgriBusinessCount'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'thesis_title' => 'nullable|string|max:255',
            'technologies' => 'nullable|string',
            'technology_generator' => 'nullable|string|max:255',
            'type_of_technology' => 'nullable|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'remarks' => 'nullable|string',
            'link' => 'nullable|string|max:255',
        ]);

        AgriBusiness::create($request->all());

        return redirect()->route('admin.agri-business.index')
            ->with('success', 'Agri-Business record created successfully.');
    }

    /**
     * Delete a record.
     */
    public function destroy($id)
    {
        try {
            $record = AgriBusiness::findOrFail($id);
            $record->delete();

            return response()->json([
                'success' => true,
                'message' => 'Agri-Business record deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to delete the record.'
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $agri = AgriBusiness::findOrFail($id);
        $agri->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully',
            'data' => $agri  // <-- add this
        ]);
    }


    /**
     * Push a record from Commercialization to Agri-Business.
     */
    public function pushFromCommercialization($id)
    {
        try {
            $commercialization = Commercialization::findOrFail($id);

            // Check if record already exists in Agri-Business
            $exists = AgriBusiness::where('thesis_title', $commercialization->thesis_title)
                ->where('technologies', $commercialization->technologies)
                ->exists();

            if ($exists) {
                return response()->json(['error' => 'Record already exists in Agri-Business.'], 409);
            }

            AgriBusiness::create([
                'thesis_title' => $commercialization->thesis_title,
                'technologies' => $commercialization->technologies,
                'technology_generator' => $commercialization->technology_generator,
                'type_of_technology' => $commercialization->type_of_technology,
                'contact_info' => $commercialization->contact_info,
                'remarks' => null,
                'link' => $commercialization->link,
            ]);

            return response()->json(['message' => 'Record pushed to Agri-Business successfully.']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to push the record.'], 500);
        }
    }
}
