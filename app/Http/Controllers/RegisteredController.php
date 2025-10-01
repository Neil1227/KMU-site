<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RegisteredTechnology; // ✅ Use RegisteredTechnology model

class RegisteredController extends Controller
{
    /**
     * Show registered technologies
     */
    public function index()
    {
        // Fetch all registered technologies from DB
        $commodities = RegisteredTechnology::latest()->get();

        return view('admin.registered-technology', compact('commodities'));
    }

    /**
     * Store pushed technology into registered technologies
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'technology' => 'required|string|max:255',
            'technology_generator' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url|max:255',
        ]);
    

        $tech = RegisteredTechnology::create([
            'technology' => $request->technology,
            'technology_generator' => $request->technology_generator,
            'description' => $request->description,
            'link' => $request->link,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Technology successfully pushed!',
            'data' => $tech
        ]);
    }
        public function destroy($id)
    {
        $tech = RegisteredTechnology::find($id);

        if (!$tech) {
            return response()->json([
                'success' => false,
                'message' => 'Technology not found.',
            ], 404);
        }

        $tech->delete();

        return response()->json([
            'success' => true,
            'message' => 'Technology successfully deleted.',
        ]);
    }
}
