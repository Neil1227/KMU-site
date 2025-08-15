<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Models\RecentActivity;

class PodcastController extends Controller
{
    public function table()
    {
        $podcasts = Podcast::latest()->get();
        return view('admin.podcast-table', compact('podcasts'));
    }

    // Store podcast
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url|max:2048', // Optional podcast link
            'png' => 'nullable|image', // Only PNG files
        ]);

        $pngFileName = null;

        if ($request->hasFile('png')) {
            $pngFileName = time() . '_' . $request->file('png')->getClientOriginalName();
            $request->file('png')->storeAs('podcast_thumbnail', $pngFileName);
        }

        Podcast::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'png' => $pngFileName,
        ]);

        RecentActivity::create([
            'action' => 'added',
            'title' => $request->title,
            'source' => 'Podcast',
        ]);

        return back()->with('success', 'Podcast uploaded successfully!');
    }

    // Delete Podcast
    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);

        // Delete thumbnail file if exists
        if ($podcast->thumbnail && \Storage::exists('podcast_thumbnail/' . $podcast->thumbnail)) {
            \Storage::delete('podcast_thumbnail/' . $podcast->thumbnail);
        }

        $title = $podcast->title;

        $podcast->delete();

        // Log to recent activities
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $title,
            'source' => 'Podcast',
        ]);

        return response()->json(['success' => true, 'message' => 'Podcast deleted successfully.']);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'link' => 'nullable|url|max:2048',
        'png' => 'nullable|image',
    ]);

    $podcast = Podcast::findOrFail($id);

    $pngFileName = $podcast->png;

    if ($request->hasFile('png')) {
        // Delete old thumbnail if exists
        if ($pngFileName && \Storage::exists('podcast_thumbnail/' . $pngFileName)) {
            \Storage::delete('podcast_thumbnail/' . $pngFileName);
        }

        $pngFileName = time() . '_' . $request->file('png')->getClientOriginalName();
        $request->file('png')->storeAs('podcast_thumbnail', $pngFileName);
    }

    $podcast->update([
        'title' => $request->title,
        'description' => $request->description,
        'link' => $request->link,
        'png' => $pngFileName,
    ]);

    // Log to recent activity
    RecentActivity::create([
        'action' => 'updated',
        'title' => $request->title,
        'source' => 'Podcast',
    ]);

    return back()->with('success', 'Podcast updated successfully!');
}
}
