<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\RecentActivity;
use Illuminate\Support\Facades\Log;

class ICTVController extends Controller
{
    // upload (create)
    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'webp' => 'nullable|file|mimes:webp',
            'png' => 'nullable|file|mimes:png',
        ]);

        $webpFilename = null;
        $pngFilename = null;

        if ($request->hasFile('webp')) {
            $webpFilename = uniqid() . '.webp';
            $request->file('webp')->storeAs('ictv_thumbnail', $webpFilename);
        }

        if ($request->hasFile('png')) {
            $pngFilename = uniqid() . '.png';
            $request->file('png')->storeAs('ictv_thumbnail', $pngFilename);
        }

        Ictv::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'webp' => $webpFilename,
            'png' => $pngFilename,
        ]);

        // Log to recent_activities table
        RecentActivity::create([
            'action' => 'added',
            'title' => $request->title,
            'source' => 'ICTV',
        ]);

        return back()->with('success', 'ICTV content uploaded successfully!');
    }

    // show episodes in table
    public function table()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::latest()->get();
        return view('admin.ictv-table', compact('episodes'));
    }

    // delete
    public function destroy($id)
    {
        $episode = Ictv::findOrFail($id);
        $title = $episode->title;
        $episode->delete();

        // Log to laravel.log (optional)
        Log::warning('ICTV Deleted', [
            'user' => Auth::check() ? Auth::user()->name : 'Guest',
            'id' => $id,
            'title' => $title,
            'timestamp' => now()
        ]);

        // Log to recent_activities table
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $title,
            'source' => 'ICTV',
        ]);

        return response()->json(['success' => true]);
    }

    // update
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|url',
            'png' => 'nullable|file|mimes:png',
            'webp' => 'nullable|file|mimes:webp',
        ]);

        $episode = Ictv::findOrFail($id);

        if ($request->hasFile('png')) {
            if ($episode->png) {
                Storage::delete('ictv_thumbnail/' . $episode->png);
            }
            $pngFilename = uniqid() . '.png';
            $request->file('png')->storeAs('ictv_thumbnail', $pngFilename);
            $episode->png = $pngFilename;
        }

        if ($request->hasFile('webp')) {
            if ($episode->webp) {
                Storage::delete('ictv_thumbnail/' . $episode->webp);
            }
            $webpFilename = uniqid() . '.webp';
            $request->file('webp')->storeAs('ictv_thumbnail', $webpFilename);
            $episode->webp = $webpFilename;
        }

        $episode->title = $request->title;
        $episode->description = $request->description;
        $episode->link = $request->link;
        $episode->save();

        // Log to recent_activities table
        RecentActivity::create([
            'action' => 'updated',
            'title' => $episode->title,
            'source' => 'ICTV',
        ]);

        return back()->with('success', 'Episode updated successfully!');
    }
}
