<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\TechnologyLicensingUnit;
use App\Models\Tbi;
use Illuminate\Http\Request;

class TechnologyLicensingUnitController extends Controller
{
    public function index()
    {
        $tluRecords = TechnologyLicensingUnit::latest()->get();
        return view('admin.tlu.index', compact('tluRecords'));
    }

    public function store(Request $request)
    {
        TechnologyLicensingUnit::create($request->all());
        return back()->with('success', 'Record added successfully!');
    }

    public function update(Request $request, $id)
    {
        $record = TechnologyLicensingUnit::findOrFail($id);
        $record->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Record updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $record = TechnologyLicensingUnit::findOrFail($id);
        $record->delete();

        return response()->json([
            'success' => true,
            'message' => 'Record deleted successfully'
        ]);
    }
    public function pushToTbi($id)
    {
        try {
            $tlu = TechnologyLicensingUnit::findOrFail($id);

            // Prevent duplicate push
            if (Tbi::where('tlu_id', $id)->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'This record is already pushed to TBI.'
                ], 409);
            }

            // Create the TBI record
            Tbi::create([
                'tlu_id'               => $tlu->id,
                'thesis_title'         => $tlu->thesis_title,
                'technologies'         => $tlu->technologies,
                'technology_generator' => $tlu->technology_generator,
                'type_of_technology'   => $tlu->type_of_technology,
                'contact_info'         => $tlu->contact_info,
                'remarks'              => null,  // do NOT copy existing remarks
                'link'                 => $tlu->link,
            ]);

            // ⬅️ REMOVE IT FROM THE TLÜ TABLE
            $tlu->delete();

            return response()->json([
                'success' => true,
                'message' => 'Record pushed to TBI successfully and removed from TLÜ.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Unable to push this record.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
