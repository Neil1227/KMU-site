<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Newsletter;
use App\Models\RecentActivity;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderBy('created_at', 'asc')->get();
        return view('admin.newsletter-table', compact('newsletters'));
    }

    public function table()
    {
        $newsletters = Newsletter::all();
        return view('admin.newsletter-table', compact('newsletters'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'newsletter-pdf' => 'nullable|mimes:pdf',
            'newsletter-png' => 'nullable|image|mimes:png',
        ]);

        $newsletter = new Newsletter();
        $newsletter->title = $request->title;

    if ($request->hasFile('newsletter-pdf')) {
        $pdfName = time() . '_' . $request->file('newsletter-pdf')->getClientOriginalName();
        $request->file('newsletter-pdf')->storeAs('newsletter', $pdfName, 'public');
        $newsletter->file = $pdfName;
    }

    if ($request->hasFile('newsletter-png')) {
        $imageName = time() . '_' . $request->file('newsletter-png')->getClientOriginalName();
        $request->file('newsletter-png')->storeAs('newsletter_thumbnail', $imageName, 'public');
        $newsletter->png = $imageName;
    }


        $newsletter->save();

        // Log recent activity: added
        RecentActivity::create([
            'action' => 'added',
            'title' => $newsletter->title,
            'source' => 'Newsletter',
        ]);

        return redirect()->back()->with('success', 'Newsletter uploaded successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf',
            'png' => 'nullable|image|mimes:png',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->title = $request->title;

    if ($request->hasFile('file')) {
        $fileName = time() . '_' . $request->file('file')->getClientOriginalName();
        $request->file('file')->storeAs('newsletter', $fileName, 'public');
        $newsletter->file = $fileName;
    }

    if ($request->hasFile('png')) {
        $pngName = time() . '_' . $request->file('png')->getClientOriginalName();
        $request->file('png')->storeAs('newsletter_thumbnail', $pngName, 'public');
        $newsletter->png = $pngName;
    }


        $newsletter->save();

        // Log recent activity: updated
        RecentActivity::create([
            'action' => 'updated',
            'title' => $newsletter->title,
            'source' => 'Newsletter',
        ]);

        return response()->json(['message' => 'Newsletter updated successfully.']);
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        if ($newsletter->file && Storage::disk('public')->exists('newsletter/' . $newsletter->file)) {
            Storage::disk('public')->delete('newsletter/' . $newsletter->file);
        }

        if ($newsletter->png && Storage::disk('public')->exists('newsletter_thumbnail/' . $newsletter->png)) {
            Storage::disk('public')->delete('newsletter_thumbnail/' . $newsletter->png);
        }

        $deletedTitle = $newsletter->title; // Save before delete
        $newsletter->delete();

        // Log recent activity: deleted
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $deletedTitle,
            'source' => 'Newsletter',
        ]);

        return response()->json(['success' => 'Newsletter deleted successfully.']);
    }
}
