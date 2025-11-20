<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demographic;

class DemographicController extends Controller
{
    public function index()
    {
        $demographics = Demographic::latest()->get();
        return view('admin.visitors', compact('demographics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'region' => 'required|string',
            'sex'    => 'required|string',
            'status' => 'required|string',
        ]);

        Demographic::create([
            'region' => $request->region,
            'sex'    => $request->sex,
            'status' => $request->status,
        ]);

        return response()->json(['status' => 'success']);
    }
    public function destroy($id)
    {
        $profile = Demographic::findOrFail($id);
        $profile->delete();

        return response()->json(['success' => true, 'message' => 'Visitor profile deleted successfully.']);
    }
}
