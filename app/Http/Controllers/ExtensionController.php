<?php

namespace App\Http\Controllers;

use App\Models\Commodity;
use App\Models\Extension;
use App\Models\Kmu_Thesis;
use App\Models\Research;

class ExtensionController extends Controller
{
    /**
     * Display a listing of all Extension entries.
     */
    public function index()
    {
        $extensions = Extension::orderBy('created_at', 'desc')->get()->map(function ($item) {
            $existsInKmu = Kmu_Thesis::where('title', $item->title)
                ->where('authors', $item->authors)
                ->exists();

            $existsInCommodity = Commodity::where('thesis_title', $item->title)
                ->where('technology_generator', $item->authors)
                ->exists();

            $item->source = ($existsInKmu || $existsInCommodity) ? 'KMU Thesis' : 'Research';

            return $item;
        });

        // Mark all 'active' as viewed once user opens the page
        Extension::where('status', 'active')->update(['status' => 'viewed']);

        // Optional: Get updated count (for the view)
        $pendingCount = Extension::where('status', 'active')->count();

        return view('admin.extension', compact('extensions', 'pendingCount'));
    }

    /**
     * Push a research entry to the Extension table
     */
    public function pushToExtension($id)
    {
        // Try to find the record in Kmu_Thesis first
        $kmuResearch = Kmu_Thesis::find($id);

        // If not found in KMU, try Research
        $research = $kmuResearch ?? Research::find($id);

        if (! $research) {
            return response()->json([
                'success' => false,
                'message' => 'Research not found.',
            ]);
        }

        // Prevent duplicate entries in Extension
        $exists = Extension::where('title', $research->title)
            ->where('authors', $research->authors)
            ->exists();

        if ($exists) {
            return response()->json([
                'success' => false,
                'message' => 'This research already exists in Extension.',
            ]);
        }

        // Insert into Extension table
        Extension::create([
            'title' => $research->title,
            'authors' => $research->authors,
            'technology_type' => $research->technology_type,
            'priority_area' => $research->priority_area,
            'link' => $research->link,
            'status' => 'active',
        ]);

        // No deletion anymore

        return response()->json([
            'success' => true,
            'message' => 'Successfully pushed to Extension!',
        ]);
    }

    public function pushfromrecords($id)
    {
        $record = Commodity::findOrFail($id);

        // Check if a similar Extension record already exists (use title + priority_area for matching)
        $exists = Extension::where('title', $record->thesis_title)
            ->where('priority_area', $record->priority_area)
            ->exists();

        if ($exists) {
            return response()->json([
                'status' => 'exists',
                'message' => 'Record already exists in Extensions.',
            ]);
        }

        // Create new Extension record using mapped fields
        Extension::create([
            'title' => $record->thesis_title,
            'authors' => $record->technology_generator,
            'technology_type' => $record->type_of_technology,
            'priority_area' => $record->priority_area,
            'link' => $record->link,
            'status' => 'active', // ✅ Same as the one used for the badge
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Record successfully pushed to Extensions.',
        ]);
    }

    /**
     * Delete an extension record.
     */
    public function destroy($id)
    {
        $extension = Extension::find($id);

        if (! $extension) {
            return response()->json([
                'success' => false,
                'message' => 'Extension record not found.',
            ]);
        }

        $extension->delete();

        return response()->json([
            'success' => true,
            'message' => 'Extension record deleted successfully.',
        ]);
    }
}
