<?php

namespace App\Http\Controllers;


use App\Models\Sdg;
use Illuminate\Http\Request;

class SdgAdminController extends Controller
{
    public function index()
    {
        $sdgs = Sdg::orderBy('sdg_number')->get();
        return view('admin.sdg.index', compact('sdgs'));
    }

    public function update(Request $request, Sdg $sdg)
    {
        $request->validate([
            'description' => 'required|string',
        ]);

        $sdg->update([
            'description' => $request->description,
        ]);

        return response()->json(['success' => true]);
    }
}
