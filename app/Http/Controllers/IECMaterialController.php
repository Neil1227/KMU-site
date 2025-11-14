<?php

namespace App\Http\Controllers;

use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IECMaterialController extends Controller
{
    /**
     * Display the IEC Materials dashboard
     */
    public function index()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();

        return view('admin.iec-table', compact('iecMaterials', 'episodes', 'modules'));
    }

    /**
     * Upload a new IEC Material
     */
    public function upload(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf',
            'png' => 'nullable|image',
        ]);

        $pdfName = $this->storeFile($request, 'pdf', 'iec_brochure');
        $pngName = $this->storeFile($request, 'png', 'iec_thumbnail');

        $iec = IECMaterial::create([
            'title' => $validated['title'],
            'file' => $pdfName,
            'png' => $pngName,
        ]);

        $this->logActivity('added', $iec->title);

        return redirect()->back()->with('success', 'IEC Material uploaded successfully.');
    }

    /**
     * Update an existing IEC Material
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'file' => 'nullable|mimes:pdf',
            'png' => 'nullable|image',
        ]);

        $material = IECMaterial::findOrFail($id);
        $material->title = $request->title;

        if ($request->hasFile('file')) {
            $material->file = $this->storeFile($request, 'file', 'iec_brochure');
        }

        if ($request->hasFile('png')) {
            $material->png = $this->storeFile($request, 'png', 'iec_thumbnail');
        }

        $material->save();

        $this->logActivity('updated', $material->title);

        return response()->json(['message' => 'IEC Material updated successfully!']);
    }

    /**
     * Delete an IEC Material
     */
    public function destroy($id)
    {
        $material = IECMaterial::findOrFail($id);

        if ($material->file && Storage::disk('public')->exists('iec_brochure/'.$material->file)) {
            Storage::disk('public')->delete('iec_brochure/'.$material->file);
        }

        if ($material->png && Storage::disk('public')->exists('iec_thumbnail/'.$material->png)) {
            Storage::disk('public')->delete('iec_thumbnail/'.$material->png);
        }

        $title = $material->title;
        $material->delete();

        $this->logActivity('deleted', $title);

        return response()->json(['success' => 'IEC Material deleted successfully.']);
    }

    /**
     * Store uploaded file with unique filename
     */
    private function storeFile(Request $request, string $field, string $folder): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        $file = $request->file($field);
        $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $file->getClientOriginalExtension();
        $baseName = str_replace(' ', '_', $originalName);
        $fileName = $baseName.'.'.$extension;
        $counter = 1;

        while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
            $fileName = $baseName.'_('.$counter.').'.$extension;
            $counter++;
        }

        $file->storeAs($folder, $fileName, 'public');

        return $fileName;
    }

    /**
     * Log recent activity
     */
    private function logActivity(string $action, string $title)
    {
        RecentActivity::create([
            'action' => $action,
            'title' => $title,
            'source' => 'IEC Material',
        ]);
    }
}
