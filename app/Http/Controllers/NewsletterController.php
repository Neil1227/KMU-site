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
        $newsletters = Newsletter::latest()->get();
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
            'newsletter-pdf' => 'nullable|mimes:pdf|max:5120',
            'newsletter-png' => 'nullable|image|mimes:png|max:2048',
        ]);

        $newsletter = new Newsletter();
        $newsletter->title = $request->title;

        if ($request->hasFile('newsletter-pdf')) {
            $pdfPath = $request->file('newsletter-pdf')->store('newsletter', 'public');
            $newsletter->file = basename($pdfPath);
        }

        if ($request->hasFile('newsletter-png')) {
            $imagePath = $request->file('newsletter-png')->store('newsletter_thumbnail', 'public');
            $newsletter->png = basename($imagePath);
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
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'png' => 'nullable|image|mimes:png|max:2048',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->title = $request->title;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('newsletter', 'public');
            $newsletter->file = basename($filePath);
        }

        if ($request->hasFile('png')) {
            $pngPath = $request->file('png')->store('newsletter_thumbnail', 'public');
            $newsletter->png = basename($pngPath);
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
