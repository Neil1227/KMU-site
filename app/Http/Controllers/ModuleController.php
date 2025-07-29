<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\RecentActivity; // ← Include this

class ModuleController extends Controller
{
    public function table()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();

        return view('admin.modules-table', compact('iecMaterials', 'episodes', 'modules'));
    }

    public function upload(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:5120',
            'png' => 'nullable|image|mimes:png|max:2048',
        ]);

        $pdfPath = null;
        $imagePath = null;

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('modules', 'public');
        }

        if ($request->hasFile('png')) {
            $imagePath = $request->file('png')->store('modules_thumbnail', 'public');
        }

        $module = Module::create([
            'title' => $validated['title'],
            'file' => basename($pdfPath),
            'png' => $imagePath ? basename($imagePath) : null,
        ]);

        // Log recent activity
        RecentActivity::create([
            'action' => 'added',
            'title' => $module->title,
            'source' => 'Modules'
        ]);

        return redirect()->back()->with('success', 'Module uploaded successfully.');
    }

    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        // Delete PDF if exists
        if ($module->file && \Storage::disk('public')->exists('modules/' . $module->file)) {
            \Storage::disk('public')->delete('modules/' . $module->file);
        }

        // Delete PNG thumbnail if exists
        if ($module->png && \Storage::disk('public')->exists('modules_thumbnail/' . $module->png)) {
            \Storage::disk('public')->delete('modules_thumbnail/' . $module->png);
        }

        $deletedTitle = $module->title;
        $module->delete();

        // Log recent activity
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $deletedTitle,
            'source' => 'Modules'
        ]);

        return response()->json(['success' => 'Module deleted successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'pdf' => 'nullable|mimes:pdf',
            'png' => 'nullable|image|mimes:png',
        ]);

        $module = Module::findOrFail($id);
        $module->title = $request->title;

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('modules', 'public');
            $module->file = basename($pdfPath);
        }

        if ($request->hasFile('png')) {
            $pngPath = $request->file('png')->store('modules_thumbnail', 'public');
            $module->png = basename($pngPath);
        }

        $module->save();

        // Log recent activity
        RecentActivity::create([
            'action' => 'updated',
            'title' => $module->title,
            'source' => 'Modules'
        ]);

        return response()->json(['message' => 'Module updated successfully!']);
    }
}
