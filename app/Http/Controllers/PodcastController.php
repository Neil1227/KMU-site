<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Podcast;
use App\Models\RecentActivity;
use Illuminate\Support\Facades\Storage;

class PodcastController extends Controller
{
    public function table()
    {
        $podcasts = Podcast::latest()->get();
        return view('admin.podcast-table', compact('podcasts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
            'png' => 'nullable|image|mimes:png,jpg,jpeg,gif',
        ]);

        $pngFileName = null;
        if ($request->hasFile('png')) {
            $file = $request->file('png');
            $pngFileName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('podcast_thumbnail', $pngFileName);
        }

        $podcast = Podcast::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'png' => $pngFileName,
        ]);

        RecentActivity::create([
            'action' => 'added',
            'title' => $podcast->title,
            'source' => 'Podcast',
        ]);

        return back()->with('success', 'Podcast uploaded successfully!');
    }

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'link' => 'nullable|string',
        'png' => 'nullable|image|mimes:png,jpg,jpeg,gif',
    ]);

    $podcast = Podcast::findOrFail($id);

    $pngFileName = $podcast->png; // keep existing

    // Handle thumbnail
    if ($request->hasFile('png')) {
        // Delete old file if exists
        if ($pngFileName && Storage::exists('podcast_thumbnail/' . $pngFileName)) {
            Storage::delete('podcast_thumbnail/' . $pngFileName);
        }

        // Save new file
        $file = $request->file('png');
        $pngFileName = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('podcast_thumbnail', $pngFileName);
    }

    // Update all fields including png
    $podcast->update([
        'title' => $request->title,
        'description' => $request->description,
        'link' => $request->link,
        'png' => $pngFileName, // make sure to include this
    ]);

    RecentActivity::create([
        'action' => 'updated',
        'title' => $podcast->title,
        'source' => 'Podcast',
    ]);

    return response()->json([
    'message' => 'Podcast updated successfully!',
]);

}


    public function destroy($id)
    {
        $podcast = Podcast::findOrFail($id);

        if ($podcast->png && Storage::exists('podcast_thumbnail/' . $podcast->png)) {
            Storage::delete('podcast_thumbnail/' . $podcast->png);
        }

        $title = $podcast->title;
        $podcast->delete();

        RecentActivity::create([
            'action' => 'deleted',
            'title' => $title,
            'source' => 'Podcast',
        ]);

        return response()->json(['success' => true]);
    }
}
