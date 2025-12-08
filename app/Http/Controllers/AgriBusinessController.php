<?php

namespace App\Http\Controllers;

use App\Models\AgriBusiness;
use App\Models\Commercialization;
use App\Models\TechnologyLicensingUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


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
        try {
            $agri = AgriBusiness::create([
                'thesis_title'         => $request->thesis_title,
                'technologies'         => $request->technologies,
                'technology_generator' => $request->technology_generator,
                'type_of_technology'   => $request->type_of_technology,
                'contact_info'         => $request->contact_info,
                'remarks'              => $request->remarks,
                'link'                 => $request->link,
            ]);



            return response()->json([
                'success' => true,
                'message' => 'Record pushed to Agri-Business and removed from Commercialization!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to push record.',
                'error' => $e->getMessage()
            ], 500);
        }
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
    public function pushFromCommercialization($id, Request $request)
    {
        $comm = Commercialization::findOrFail($id);

        // Optional duplicate check
        $exists = AgriBusiness::where('thesis_title', $comm->thesis_title)
            ->where('technologies', $comm->technologies)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already exists in Agri-Business.'], 409);
        }

        $agri = AgriBusiness::create([
            'thesis_title' => $comm->thesis_title,
            'technologies' => $comm->technologies,
            'technology_generator' => $comm->technology_generator,
            'type_of_technology' => $comm->type_of_technology,
            'contact_info' => $comm->contact_info,
            'remarks' => $comm->remarks,
            'link' => $comm->link,

        ]);

        // Update the pushed_to_agri flag
        $comm->update(['pushed_to_agri' => true]);

        return response()->json(['success' => true, 'message' => 'Pushed to Agri-Business!']);
    }

    public function pushToTLU($id)
    {
        $agri = AgriBusiness::findOrFail($id);

        $newTLU = TechnologyLicensingUnit::create([
            'thesis_title'         => $agri->thesis_title,
            'technologies'         => $agri->technologies,
            'technology_generator' => $agri->technology_generator,
            'type_of_technology'   => $agri->type_of_technology,
            'contact_info'         => $agri->contact_info,
            'remarks'              => $agri->remarks,
            'link'                 => $agri->link,
        ]);

        // DELETE the original AgriBusiness record after pushing
        $agri->delete();

        return response()->json([
            'success' => true,
            'message' => 'Record successfully pushed to Technology Licensing Unit and removed from Agri-Business!'
        ]);
    }
}
