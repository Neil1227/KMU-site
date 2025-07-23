<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::latest()->get();
        return view('admin.newsletter-table', compact('newsletters'));
    }

    public function table()
    {
        $newsletters = Newsletter::all(); // adjust model if needed
        return view('admin.newsletter-table', compact('newsletters'));
    }


    public function upload(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:5120',
            'png' => 'nullable|image|mimes:png|max:2048',
        ]);

        $pdfPath = null;
        $imagePath = null;

        if ($request->hasFile('file')) {
            $pdfPath = $request->file('file')->store('newsletter_files', 'public');
        }

        if ($request->hasFile('png')) {
            $imagePath = $request->file('png')->store('newsletter_thumbnails', 'public');
        }

        Newsletter::create([
            'title' => $validated['title'],
            'file' => $pdfPath ? basename($pdfPath) : null,
            'png' => $imagePath ? basename($imagePath) : null,
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
            $filePath = $request->file('file')->store('newsletter_files', 'public');
            $newsletter->file = basename($filePath);
        }

        if ($request->hasFile('png')) {
            $pngPath = $request->file('png')->store('newsletter_thumbnails', 'public');
            $newsletter->png = basename($pngPath);
        }

        $newsletter->save();

        return response()->json(['message' => 'Newsletter updated successfully.']);
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);

        if ($newsletter->file && \Storage::disk('public')->exists('newsletter_files/' . $newsletter->file)) {
            \Storage::disk('public')->delete('newsletter_files/' . $newsletter->file);
        }

        if ($newsletter->png && \Storage::disk('public')->exists('newsletter_thumbnails/' . $newsletter->png)) {
            \Storage::disk('public')->delete('newsletter_thumbnails/' . $newsletter->png);
        }

        $newsletter->delete();

        return response()->json(['success' => 'Newsletter deleted successfully.']);
    }
}
