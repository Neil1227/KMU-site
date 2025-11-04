<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use App\Models\Kmu_Thesis;
use App\Models\Research;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class ExtensionController extends Controller
{
    /**
     * Display a listing of all Extension entries.
     */
public function index()
{
    $extensions = Extension::orderBy('created_at', 'desc')->get()->map(function ($item) {
        // Check if this extension record exists in KMU_Thesis
        $existsInKmu = Kmu_Thesis::where('title', $item->title)
            ->where('authors', $item->authors)
            ->exists();

        // Dynamically assign the source
        $item->source = $existsInKmu ? 'KMU Thesis' : 'Research';
        return $item;
    });

    // Count active extensions
    $pendingCount = Extension::where('status', 'active')->count();

    return view('admin.extension', compact('extensions', 'pendingCount'));
}






    /**
     * Push a research entry to the Extension table and remove it from Research.
     */
public function pushToExtension($id)
{
    // Try to find the record in Kmu_Thesis first
    $kmuResearch = Kmu_Thesis::find($id);

    // If not found in KMU, try Research
    $research = $kmuResearch ?? Research::find($id);

    if (!$research) {
        return response()->json([
            'success' => false,
            'message' => 'Research not found.'
        ]);
    }

    // Prevent duplicate entries in Extension
    $exists = Extension::where('title', $research->title)
        ->where('authors', $research->authors)
        ->exists();

    if ($exists) {
        return response()->json([
            'success' => false,
            'message' => 'This research already exists in Extension.'
        ]);
    }

    // Insert into Extension table
    Extension::create([
        'title'           => $research->title,
        'authors'         => $research->authors,
        'technology_type' => $research->technology_type,
        'priority_area'   => $research->priority_area,
        'link'            => $research->link,
        'status'          => 'active',
    ]);

    // No deletion anymore

    return response()->json([
        'success' => true,
        'message' => 'Successfully pushed to Extension!'
    ]);
}




    /**
     * Delete an extension record.
     */
    public function destroy($id)
    {
        $extension = Extension::find($id);

        if (!$extension) {
            return response()->json([
                'success' => false,
                'message' => 'Extension record not found.'
            ]);
        }

        $extension->delete();

        return response()->json([
            'success' => true,
            'message' => 'Extension record deleted successfully.'
        ]);
    }
}
