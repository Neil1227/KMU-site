<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'newsletter-png' => 'nullable|image',
        ]);

        $newsletter = new Newsletter;
        $newsletter->title = $request->title;

        // Function to get unique filename
        $getUniqueFilename = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // Replace spaces with underscores
            $baseName = str_replace(' ', '_', $originalName);
            $fileName = $baseName.'.'.$extension;

            $counter = 1;

            // Check if file exists and increment if necessary
            while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
                $fileName = $baseName.'_('.$counter.').'.$extension;
                $counter++;
            }

            return $fileName;
        };

        if ($request->hasFile('newsletter-pdf')) {
            $pdfName = $getUniqueFilename($request->file('newsletter-pdf'), 'newsletter');
            $request->file('newsletter-pdf')->storeAs('newsletter', $pdfName, 'public');
            $newsletter->file = $pdfName;
        }

        if ($request->hasFile('newsletter-png')) {
            $imageName = $getUniqueFilename($request->file('newsletter-png'), 'newsletter_thumbnail');
            $request->file('newsletter-png')->storeAs('newsletter_thumbnail', $imageName, 'public');
            $newsletter->png = $imageName;
        }

        $newsletter->save();

        // Log recent activity
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
            'png' => 'nullable|image',
        ]);

        $newsletter = Newsletter::findOrFail($id);
        $newsletter->title = $request->title;

        // Function to get unique filename
        $getUniqueFilename = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            // Replace spaces with underscores
            $baseName = str_replace(' ', '_', $originalName);
            $fileName = $baseName.'.'.$extension;

            $counter = 1;

            // Check if file exists and increment if necessary
            while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
                $fileName = $baseName.'_('.$counter.').'.$extension;
                $counter++;
            }

            return $fileName;
        };

        if ($request->hasFile('file')) {
            $fileName = $getUniqueFilename($request->file('file'), 'newsletter');
            $request->file('file')->storeAs('newsletter', $fileName, 'public');
            $newsletter->file = $fileName;
        }

        if ($request->hasFile('png')) {
            $pngName = $getUniqueFilename($request->file('png'), 'newsletter_thumbnail');
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

        if ($newsletter->file && Storage::disk('public')->exists('newsletter/'.$newsletter->file)) {
            Storage::disk('public')->delete('newsletter/'.$newsletter->file);
        }

        if ($newsletter->png && Storage::disk('public')->exists('newsletter_thumbnail/'.$newsletter->png)) {
            Storage::disk('public')->delete('newsletter_thumbnail/'.$newsletter->png);
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
