<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account-settings');
    }

public function store(Request $request)
{
    $request->validate([
        'user' => 'required|string|unique:admins,user',
        'password' => 'required|confirmed|min:4',
        'role' => 'required|in:KMU,IPTBM,TBI',
    ]);

    Admin::create([
        'user' => $request->user,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return back()->with('success', 'Account created successfully.');
}

public function update(Request $request)
{
    $adminId = Session::get('admin_id');
    $admin = Admin::findOrFail($adminId);

    // Base validation
    $request->validate([
        'current_password' => 'required|string',
        'update_option' => 'required|in:username,password,both,role',
    ]);

    // Verify current password
    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->with('error', 'Current password is incorrect.');
    }

    $updateData = [];

    // === Update username ===
    if (in_array($request->update_option, ['username', 'both'])) {
        $request->validate([
            'new_user' => 'required|string|unique:admins,user,' . $admin->id,
        ]);
        $updateData['user'] = $request->new_user;
        Session::put('admin_user', $request->new_user);
    }

    // === Update password ===
    if (in_array($request->update_option, ['password', 'both'])) {
        $request->validate([
            'new_password' => 'required|confirmed|min:4',
        ]);
        $updateData['password'] = Hash::make($request->new_password);
    }

    // === Update role (only if KMU super admin) ===
    if ($request->update_option === 'role') {
        if ($admin->role !== 'KMU') {
            return back()->with('error', 'Only KMU Super Admin can change roles.');
        }

        $request->validate([
            'new_role' => 'required|in:KMU,IPTBM,TBI',
        ]);
        $updateData['role'] = $request->new_role;
    }

    $admin->update($updateData);

    return back()->with('success', 'Account updated successfully.');
}

}
