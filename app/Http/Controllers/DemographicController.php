<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demographic;

class DemographicController extends Controller
{
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
}
