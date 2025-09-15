<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PromotionalActivity;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\RecentActivity;

class PromotionalActivityController extends Controller
{

    // show episodes in table
    public function table()
    {
        $promotional = PromotionalActivity::latest()->get();
        return view('admin.promotionalactivities-table', compact('promotional'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
            'png' => 'nullable|image', // ✅ match the db column
        ]);

        $pngFilename = null;

        if ($request->hasFile('png')) {
            $pngFilename = $request->file('png')->getClientOriginalName();
            $request->file('png')->storeAs('promotional_thumbnail', $pngFilename);
        }

        PromotionalActivity::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'png' => $pngFilename, // ✅ match the db column
        ]);

        RecentActivity::create([
            'action' => 'added',
            'title' => $request->title,
            'source' => 'Promotional Activity',
        ]);

        return back()->with('success', 'Promotional Activity uploaded successfully!');
    }

    // Update promotional activity
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
            'png' => 'nullable|image',
        ]);

        $activity = PromotionalActivity::findOrFail($id);

        // Handle optional thumbnail replacement
        if ($request->hasFile('png')) {
            // Delete old file if exists
            if ($activity->png) {
                Storage::delete('promotional_thumbnail/' . $activity->png);
            }

            $pngFilename = $request->file('png')->getClientOriginalName();
            $request->file('png')->storeAs('promotional_thumbnail', $pngFilename);

            $activity->png = $pngFilename;
        }

        $activity->title = $request->title;
        $activity->description = $request->description;
        $activity->link = $request->link;
        $activity->save();

        RecentActivity::create([
            'action' => 'updated',
            'title' => $request->title,
            'source' => 'Promotional Activity',
        ]);

        return back()->with('success', 'Promotional Activity updated successfully!');
    }

    public function destroy($id)
    {
        $activity = PromotionalActivity::findOrFail($id);

        // Optional: delete thumbnail from storage
        if ($activity->png) {
            Storage::delete('promotional_thumbnail/' . $activity->png);
        }

        $activityTitle = $activity->title;

        $activity->delete();

        // Log the deletion
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $activityTitle,
            'source' => 'Promotional Activity',
        ]);

        return response()->json(['message' => 'Deleted successfully']);
    }



}
