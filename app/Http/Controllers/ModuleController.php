<?php

namespace App\Http\Controllers;

use App\Models\Ictv;
use App\Models\IECMaterial;
use App\Models\Module;
use App\Models\RecentActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'pdf' => 'nullable|file|mimes:pdf',
            'png' => 'nullable|image',
        ]);

        $pdfName = null;
        $imageName = null;

        // Function to get unique filename
        $getUniqueFilename = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $baseName = str_replace(' ', '_', $originalName);
            $fileName = $baseName.'.'.$extension;

            $counter = 1;

            while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
                $fileName = $baseName.'_('.$counter.').'.$extension;
                $counter++;
            }

            return $fileName;
        };

        if ($request->hasFile('pdf')) {
            $pdfName = $getUniqueFilename($request->file('pdf'), 'modules');
            $request->file('pdf')->storeAs('modules', $pdfName, 'public');
        }

        if ($request->hasFile('png')) {
            $imageName = $getUniqueFilename($request->file('png'), 'modules_thumbnail');
            $request->file('png')->storeAs('modules_thumbnail', $imageName, 'public');
        }

        $module = Module::create([
            'title' => $validated['title'],
            'file' => $pdfName,
            'png' => $imageName,
        ]);

        // Log recent activity
        RecentActivity::create([
            'action' => 'added',
            'title' => $module->title,
            'source' => 'Modules',
        ]);

        return redirect()->back()->with('success', 'Module uploaded successfully.');
    }

    public function destroy($id)
    {
        $module = Module::findOrFail($id);

        // Delete PDF if exists
        if ($module->file && Storage::disk('public')->exists('modules/'.$module->file)) {
            Storage::disk('public')->delete('modules/'.$module->file);
        }

        // Delete PNG thumbnail if exists
        if ($module->png && Storage::disk('public')->exists('modules_thumbnail/'.$module->png)) {
            Storage::disk('public')->delete('modules_thumbnail/'.$module->png);
        }

        $deletedTitle = $module->title;
        $module->delete();

        // Log recent activity
        RecentActivity::create([
            'action' => 'deleted',
            'title' => $deletedTitle,
            'source' => 'Modules',
        ]);

        return response()->json(['success' => 'Module deleted successfully.']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'pdf' => 'nullable|mimes:pdf',
            'png' => 'nullable|image',
        ]);

        $module = Module::findOrFail($id);
        $module->title = $request->title;

        // Function to get unique filename
        $getUniqueFilename = function ($file, $folder) {
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();

            $baseName = str_replace(' ', '_', $originalName);
            $fileName = $baseName.'.'.$extension;

            $counter = 1;

            while (Storage::disk('public')->exists($folder.'/'.$fileName)) {
                $fileName = $baseName.'_('.$counter.').'.$extension;
                $counter++;
            }

            return $fileName;
        };

        if ($request->hasFile('pdf')) {
            $pdfName = $getUniqueFilename($request->file('pdf'), 'modules');
            $request->file('pdf')->storeAs('modules', $pdfName, 'public');
            $module->file = $pdfName;
        }

        if ($request->hasFile('png')) {
            $pngName = $getUniqueFilename($request->file('png'), 'modules_thumbnail');
            $request->file('png')->storeAs('modules_thumbnail', $pngName, 'public');
            $module->png = $pngName;
        }

        $module->save();

        // Log recent activity
        RecentActivity::create([
            'action' => 'updated',
            'title' => $module->title,
            'source' => 'Modules',
        ]);

        return response()->json(['message' => 'Module updated successfully!']);
    }
}
