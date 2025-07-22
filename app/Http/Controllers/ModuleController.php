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
    
    public function index()
    {
        $iecMaterials = IECMaterial::latest()->get();
        $episodes = Ictv::all();
        $modules = Module::latest()->get();

        return view('admin.modules', compact('iecMaterials', 'episodes', 'modules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf,zip|max:10240',
            'png' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $validated['file'] = $request->file('file')->store('module_files', 'public');
        }

        if ($request->hasFile('png')) {
            $validated['png'] = $request->file('png')->store('module_thumbnails', 'public');
        }

        Module::create($validated);

        return redirect()->back()->with('success', 'Module uploaded successfully.');
    }
}

