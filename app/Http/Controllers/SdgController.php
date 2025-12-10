<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sdg;
use App\Models\SDGMedia;

class SdgController extends Controller
{
    public function index()
    {
        $sdgs = Sdg::orderBy('sdg_number')->get();

        // Make sure the view name is correct!
        return view('sdg', compact('sdgs'));

        // 'sdgs.sdgs' assumes the Blade is at resources/views/sdgs/sdgs.blade.php
    }
    public function show($sdg)
    {
        $sdgData = Sdg::where('sdg_number', $sdg)->firstOrFail();

        $galleryImages = SDGMedia::where('sdg_id', $sdgData->id)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($item) {
                return [
                    'image' => asset('storage/' . $item->image),
                    'title' => $item->title,
                    'sdg-targets' => $item->sdg_targets,
                ];
            })
            ->toArray();



        return view('sdg-gallery', compact('sdgData', 'galleryImages'));
    }
    public function update(Request $request, $id)
    {
        $sdg = Sdg::findOrFail($id);

        $sdg->update([
            'sdg_number' => $request->sdg_number,
            'title'      => $request->title,
            'description' => $request->description,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'SDG updated successfully.',
            'data' => $sdg
        ]);
    }
}
