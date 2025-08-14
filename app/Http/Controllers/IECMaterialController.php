<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\RecentActivity;

class IECMaterialController extends Controller
{
    public function index()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();
        return view('admin.iec-table', compact('iecMaterials', 'episodes', 'modules'));
    }

public function upload(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'pdf' => 'nullable|file|mimes:pdf',
        'png' => 'nullable|image|mimes:png',
    ]);

    $pdfName = null;
    $imageName = null;

    // Function to get unique filename
    $getUniqueFilename = function ($file, $folder) {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $baseName = str_replace(' ', '_', $originalName);
        $fileName = $baseName . '.' . $extension;

        $counter = 1;

        while (\Storage::disk('public')->exists($folder . '/' . $fileName)) {
            $fileName = $baseName . '_(' . $counter . ').' . $extension;
            $counter++;
        }

        return $fileName;
    };

    if ($request->hasFile('pdf')) {
        $pdfName = $getUniqueFilename($request->file('pdf'), 'iec_brochure');
        $request->file('pdf')->storeAs('iec_brochure', $pdfName, 'public');
    }

    if ($request->hasFile('png')) {
        $imageName = $getUniqueFilename($request->file('png'), 'iec_thumbnail');
        $request->file('png')->storeAs('iec_thumbnail', $imageName, 'public');
    }

    $iec = IECMaterial::create([
        'title' => $validated['title'],
        'description' => $validated['description'],
        'file' => $pdfName,
        'png' => $imageName,
    ]);

    // Log activity
    RecentActivity::create([
        'action' => 'added',
        'title' => $iec->title,
        'source' => 'IEC Material',
    ]);

    return redirect()->back()->with('success', 'IEC Material uploaded successfully.');
}



    public function destroy($id)
    {
        $material = IECMaterial::findOrFail($id);
        $title = $material->title;

        if ($material->file && \Storage::disk('public')->exists($material->file)) {
            \Storage::disk('public')->delete($material->file);
        }

        if ($material->png && \Storage::disk('public')->exists('iec_thumbnail/' . $material->png)) {
            \Storage::disk('public')->delete('iec_thumbnail/' . $material->png);
        }

        $material->delete();

        // Log activity
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $title,
            'source' => 'IEC Material',
        ]);

        return response()->json(['success' => 'IEC Material deleted successfully.']);
    }

public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required|string',
        'file' => 'nullable|mimes:pdf',
        'png' => 'nullable|image|mimes:png',
    ]);

    $material = IECMaterial::findOrFail($id);
    $material->title = $request->title;
    $material->description = $request->description;

    // Function to get unique filename
    $getUniqueFilename = function ($file, $folder) {
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();

        $baseName = str_replace(' ', '_', $originalName);
        $fileName = $baseName . '.' . $extension;

        $counter = 1;

        while (\Storage::disk('public')->exists($folder . '/' . $fileName)) {
            $fileName = $baseName . '_(' . $counter . ').' . $extension;
            $counter++;
        }

        return $fileName;
    };

    if ($request->hasFile('file')) {
        $fileName = $getUniqueFilename($request->file('file'), 'iec_brochure');
        $request->file('file')->storeAs('iec_brochure', $fileName, 'public');
        $material->file = $fileName;
    }

    if ($request->hasFile('png')) {
        $pngName = $getUniqueFilename($request->file('png'), 'iec_thumbnail');
        $request->file('png')->storeAs('iec_thumbnail', $pngName, 'public');
        $material->png = $pngName;
    }

    $material->save();

    // Log activity
    RecentActivity::create([
        'action' => 'updated',
        'title' => $material->title,
        'source' => 'IEC Material',
    ]);

    return response()->json(['message' => 'IEC material updated successfully!']);
}

}
