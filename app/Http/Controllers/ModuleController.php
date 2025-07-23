<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Module;
use App\Models\Ictv;
use App\Models\IECMaterial;

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

        Module::create([
            'title' => $validated['title'],
            'file' => basename($pdfPath),
            'png' => $imagePath ? basename($imagePath) : null,
        ]);

        return redirect()->back()->with('success', 'Module uploaded successfully.');
    }
    
    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        // Delete the PDF file if it exists
        if ($module->pdf && \Storage::disk('public')->exists($module->pdf)) {
            \Storage::disk('public')->delete($module->pdf);
        }

        // Delete the PNG thumbnail if it exists
        if ($module->png && \Storage::disk('public')->exists('module_thumbnail/' . $module->png)) {
            \Storage::disk('public')->delete('module_thumbnail/' . $module->png);
        }

        $module->delete();

        return response()->json(['success' => 'Module deleted successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'pdf' => 'nullable|mimes:pdf',
            'png' => 'nullable|image|mimes:png',
        ]);

        $module = Module::findOrFail($id); // ← use $id from route

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

        return response()->json(['message' => 'Module updated successfully!']);
    }



}

