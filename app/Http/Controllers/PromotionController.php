<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Promotion;
use App\Models\Commercialization;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    public function index()
    {
        $promotionRecords = Promotion::latest()->get();
        return view('admin.tbi.promotion', compact('promotionRecords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
        ]);

        Promotion::create($request->all());

        return back()->with('success', 'Promotion record added successfully.');
    }

    public function update(Request $request, $id)
    {
        $record = Promotion::findOrFail($id);

        $record->update($request->all());

        return back()->with('success', 'Promotion record updated successfully.');
    }

    public function destroy($id)
    {
        Promotion::findOrFail($id)->delete();

        return response()->json(['success' => true]);
    }
    public function pushFromCommercial($id)
    {
        $comm = Commercialization::findOrFail($id);

        // Check if already pushed to Promotion
        if ($comm->pushed_to_promotion) {
            return response()->json([
                'message' => 'This record was already pushed to Promotional/Development.'
            ], 409); // 409 = conflict
        }

        // Optional: check if it already exists in Promotion table (for extra safety)
        $exists = Promotion::where('thesis_title', $comm->thesis_title)
            ->where('technologies', $comm->technologies)
            ->first();

        if ($exists) {
            return response()->json([
                'message' => 'This record already exists in the Promotion table.'
            ], 409);
        }

        // Push record
        Promotion::create([
            'thesis_title' => $comm->thesis_title,
            'technologies' => $comm->technologies,
            'technology_generator' => $comm->technology_generator,
            'type_of_technology' => $comm->type_of_technology,
            'contact_info' => $comm->contact_info,
            'remarks' => null,
            'link' => $comm->link,
        ]);

        // Mark commercialization as pushed to Promotion
        $comm->update(['pushed_to_promotion' => true]);

        return response()->json(['success' => true, 'message' => 'Pushed to Promotional/Development!']);
    }
}
