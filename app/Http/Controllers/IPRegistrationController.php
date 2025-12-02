<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Registration;

class IPRegistrationController extends Controller
{
    public function index()
    {
        $registrations = Registration::orderBy('date_received', 'desc')->get();
        return view('admin.registrations.index', compact('registrations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'registration_number' => 'required',
            'title' => 'required',
            'remarks' => 'nullable',
            'date_received' => 'nullable|string',
            'inventor_owner' => 'nullable|string',
            'ip_type' => 'nullable|string',
            'comment' => 'nullable|string',
            'notice' => 'nullable|string',
        ]);

        $data = $request->all();

        // Replace 'Other' with actual input value
        if ($request->remarks === 'Other' && $request->has('remarks_other')) {
            $data['remarks'] = $request->remarks_other;
        }

        if ($request->ip_type === 'Other' && $request->has('ip_type_other')) {
            $data['ip_type'] = $request->ip_type_other;
        }

        if ($request->notice === 'Other' && $request->has('notice_other')) {
            $data['notice'] = $request->notice_other;
        }

        Registration::create($data);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'New registration added successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'registration_number' => 'required',
            'title' => 'required',
            'remarks' => 'nullable',
            'date_received' => 'nullable|string',
            'inventor_owner' => 'nullable|string',
            'ip_type' => 'nullable|string',
            'comment' => 'nullable|string',
            'notice' => 'nullable|string',
        ]);

        $registration = Registration::findOrFail($id);

        $data = $request->all();

        // Handle 'Other' values
        if ($request->remarks === 'Other' && $request->has('remarks_other')) {
            $data['remarks'] = $request->remarks_other;
        }

        if ($request->ip_type === 'Other' && $request->has('ip_type_other')) {
            $data['ip_type'] = $request->ip_type_other;
        }

        if ($request->notice === 'Other' && $request->has('notice_other')) {
            $data['notice'] = $request->notice_other;
        }

        $registration->update($data);

        return redirect()->route('admin.registrations.index')
            ->with('success', 'Registration updated successfully!');
    }

    public function destroy($id)
    {
        $registration = Registration::findOrFail($id);
        $registration->delete();

        return response()->json([
            'success' => true,
            'message' => 'Registration deleted successfully!'
        ]);
    }
}
