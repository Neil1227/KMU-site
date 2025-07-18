<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use Illuminate\Support\Facades\Storage;



class ICTVController extends Controller
{

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

    return back()->with('success', 'ICTV content uploaded successfully!');
    return redirect()->back()->with('error', 'Something went wrong!');

}
//tables rendering
public function table()
{
    $episodes = Ictv::latest()->get(); // Get all episodes
    return view('admin.ictv-table', compact('episodes'));
}

//deleting record
public function destroy($id)
{
    $episode = ICTV::findOrFail($id);
    $episode->delete();

    return response()->json(['success' => true]);
}




}
