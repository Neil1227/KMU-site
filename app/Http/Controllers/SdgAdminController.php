<?php

namespace App\Http\Controllers;


use App\Models\Sdg;
use App\Models\SDGMedia;
use Illuminate\Http\Request;

class SdgAdminController extends Controller
{
    public function index()
    {
        $sdgs = Sdg::orderBy('sdg_number')->get();
        return view('admin.sdg.index', compact('sdgs'));
    }

    public function update(Request $request, Sdg $sdg)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $sdg->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }
    
    /** ============================
     *     SDG MEDIA UPLOAD PAGE
     *  ============================ */
    public function mediaIndex()
    {
        $sdgs = Sdg::orderBy('sdg_number')->get(); // for dropdown
        $media = SDGMedia::with('sdg')->latest()->get();

        return view('admin.sdg-media', compact('sdgs', 'media'));

    }

    public function mediaStore(Request $request)
    {
        $request->validate([
            'sdg_id' => 'required|integer|exists:sdgs,id',
            'title' => 'required|string|max:255',
            'sdg_targets' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        // Upload image
        $path = $request->file('image')->store('sdg_media', 'public');

        SDGMedia::create([
            'sdg_id' => $request->sdg_id,
            'title' => $request->title,
            'sdg_targets' => $request->sdg_targets,
            'image' => $path,
        ]);

        return back()->with('success', 'SDG Media uploaded successfully!');
    }
}
