<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technology;
use App\Models\RecentActivity;
use Illuminate\Support\Facades\Storage;

class TechnologyController extends Controller
{
    // Show all technologies in card list
    public function index()
    {
        $technologies = Technology::all();
        return view('media-resources-section.technology-product', compact('technologies'));
    }

    // Show single technology
    public function show($id)
    {
        $technology = Technology::findOrFail($id);
        return view('technology', compact('technology'));
    }

    // ====================admin========================
    public function table()
    {
         // fetch all technologies from the DB
        $technologies = Technology::all();

        // pass to the blade view
        return view('admin.technology-table', compact('technologies'));
    }

    //uploading of technologies
    public function upload(Request $request)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'desc' => 'required|string',
            'net' => 'required|numeric',
            'profit' => 'required|numeric',
            'inventors' => 'nullable|string',
            'ip_status' => 'required|string',
            'proposition' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
            'poster' => 'required|image|mimes:jpeg,png,jpg,gif,webp',
        ]);

        $technology = new Technology();
        $technology->product = $request->product;
        $technology->desc = $request->desc;
        $technology->net = $request->net;
        $technology->profit = $request->profit;
        $technology->ip_status = $request->ip_status;

        // Convert comma-separated strings to arrays
        $technology->inventors = $request->inventors ? array_map('trim', explode(',', $request->inventors)) : [];
        $technology->proposition = $request->proposition ? array_map('trim', explode(',', $request->proposition)) : [];
        $technology->benefits = $request->benefits ? array_map('trim', explode(',', $request->benefits)) : [];

        // Helper function to store file and return only filename
        $storeFile = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $originalName . '.' . $extension;
            $counter = 1;

            // Check if file exists
            while (\Storage::disk('public')->exists($folder . '/' . $filename)) {
                $filename = $originalName . '(' . $counter . ').' . $extension;
                $counter++;
            }

            // Store the file
            $file->storeAs($folder, $filename, 'public');

            // Return only the filename
            return $filename;
        };

        // Handle image upload
        if ($request->hasFile('image')) {
            $technology->image = $storeFile($request->file('image'), 'technologies');
        }

        // Handle poster upload
        if ($request->hasFile('poster')) {
            $technology->poster = $storeFile($request->file('poster'), 'technologies');
        }

        $technology->save();

        // Log recent activity
        RecentActivity::create([
            'action' => 'added',
            'title' => $technology->product,
            'source' => 'Technology',
        ]);

        return redirect()->back()->with('success', 'Technology uploaded successfully!');
    }

    public function delete($id)
    {
        $technology = Technology::findOrFail($id);

        // Delete image file if exists
        if ($technology->image && \Storage::disk('public')->exists('technologies/' . $technology->image)) {
            \Storage::disk('public')->delete('technologies/' . $technology->image);
        }

        // Delete poster file if exists
        if ($technology->poster && \Storage::disk('public')->exists('technologies/' . $technology->poster)) {
            \Storage::disk('public')->delete('technologies/' . $technology->poster);
        }

        // Log recent activity
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $technology->product,
            'source' => 'Technology',
        ]);

        // Delete the record
        $technology->delete();

        // ✅ Return JSON response
        return response()->json([
            'success' => 'Technology deleted successfully!'
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'net' => 'nullable|numeric',
            'profit' => 'nullable|numeric',
            'inventors' => 'nullable|string',
            'ip_status' => 'nullable|string',
            'proposition' => 'nullable|string',
            'benefits' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $technology = Technology::findOrFail($id);

        $technology->product = $request->product;
        $technology->desc = $request->desc;
        $technology->net = $request->net;
        $technology->profit = $request->profit;
        $technology->inventors = $request->inventors ? array_map('trim', explode(',', $request->inventors)) : [];
        $technology->ip_status = $request->ip_status;
        $technology->proposition = $request->proposition ? array_map('trim', explode(',', $request->proposition)) : [];
        $technology->benefits = $request->benefits ? array_map('trim', explode(',', $request->benefits)) : [];

        // Reuse the same file storage logic
        $storeFile = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filename = $originalName . '.' . $extension;
            $counter = 1;

            while (\Storage::disk('public')->exists($folder . '/' . $filename)) {
                $filename = $originalName . '(' . $counter . ').' . $extension;
                $counter++;
            }

            $file->storeAs($folder, $filename, 'public');

            return $filename;
        };

        if ($request->hasFile('image')) {
            // optionally delete old image
            if ($technology->image && \Storage::disk('public')->exists('technologies/' . $technology->image)) {
                \Storage::disk('public')->delete('technologies/' . $technology->image);
            }
            $technology->image = $storeFile($request->file('image'), 'technologies');
        }

        if ($request->hasFile('poster')) {
            if ($technology->poster && \Storage::disk('public')->exists('technologies/' . $technology->poster)) {
                \Storage::disk('public')->delete('technologies/' . $technology->poster);
            }
            $technology->poster = $storeFile($request->file('poster'), 'technologies');
        }

        $technology->save();

        RecentActivity::create([
            'action' => 'updated',
            'title' => $technology->product,
            'source' => 'Technology',
        ]);

        return back()->with('success', 'Technology updated successfully!');
    }
}

