<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\RecentActivity;

class ICTVController extends Controller
{
    // Upload (create)
    public function upload(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'link' => 'nullable|string',
            'png' => 'nullable|image', 
        ]);

        $pngFilename = null;

        // Handle file upload if provided
        if ($request->hasFile('png')) {
            $pngFile = $request->file('png');
            $pngFilename = uniqid() . '.' . $pngFile->getClientOriginalExtension();

            // Store in public disk so it is accessible via asset('storage/...')
            $pngFile->storeAs('ictv_thumbnail', $pngFilename, 'public');
        }

        // Create ICTV record
        Ictv::create([
            'title' => $request->title,
            'description' => $request->description,
            'link' => $request->link,
            'png' => $pngFilename,
        ]);

        // Log recent activity
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

        if ($episode->png) {
            Storage::delete('ictv_thumbnail/' . $episode->png);
        }

        $episode->delete();

        Log::warning('ICTV Deleted', [
            'user' => Auth::check() ? Auth::user()->name : 'Guest',
            'id' => $id,
            'title' => $title,
            'timestamp' => now()
        ]);

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
            'link' => 'nullable|string',
            'png' => 'nullable|image',
        ]);

        $episode = Ictv::findOrFail($id);

        if ($request->hasFile('png')) {
            // Delete old file if exists
            if ($episode->png) {
                Storage::disk('public')->delete('ictv_thumbnail/' . $episode->png);
            }

            // Store new file
            $pngFile = $request->file('png');
            $pngFilename = uniqid() . '.' . $pngFile->getClientOriginalExtension();
            $pngFile->storeAs('ictv_thumbnail', $pngFilename, 'public');

            $episode->png = $pngFilename;
        }

        $episode->title = $request->title;
        $episode->description = $request->description;
        $episode->link = $request->link;
        $episode->save();

        RecentActivity::create([
            'action' => 'updated',
            'title' => $episode->title,
            'source' => 'ICTV',
        ]);

        return back()->with('success', 'Episode updated successfully!');
    }

}
