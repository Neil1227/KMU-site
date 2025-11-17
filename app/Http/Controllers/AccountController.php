<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        $users = Admin::all();

        return view('admin.account-settings', compact('users'));
    }

    // === Store New Account ===
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|string|unique:admins,user',
            'password' => 'required|confirmed|min:4',
            'role' => 'required|in:KMU,IPTBM,TBI,TBI_Agribus,TBI_TLU,RESEARCH,EXTENSION',

        ], [
            'user.required' => 'Username is required.',
            'user.unique' => 'This username is already taken.',
            'password.required' => 'Password is required.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.min' => 'Password must be at least 4 characters.',
            'role.required' => 'Role selection is required.',
            'role.in' => 'Invalid role selected.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            Admin::create([
                'user' => $request->user,
                'password' => Hash::make($request->password),
                'role' => $request->role,
            ]);

            return back()->with('success', 'Account created successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while creating the account: '.$e->getMessage());
        }
    }

 public function update(Request $request)
{
    try {
        // Determine target user
        if (session('admin_role') === 'KMU') {
            $admin = Admin::findOrFail($request->id); // KMU can edit anyone
        } else {
            $admin = Admin::findOrFail(session('admin_id')); // Non-KMU can edit themselves only
        }

        // Base validation
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|string',
            'update_option' => 'required|in:username,password,both,role',
        ], [
            'current_password.required' => 'Current password is required.',
            'update_option.required' => 'Please select an update option.',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Verify current password
        if (! Hash::check($request->current_password, $admin->password)) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $updateData = [];

        // === Username Update ===
        if (in_array($request->update_option, ['username', 'both'])) {
            $validator = Validator::make($request->all(), [
                'new_user' => 'required|string|unique:admins,user,' . $admin->id,
            ], [
                'new_user.required' => 'New username is required.',
                'new_user.unique' => 'This username is already taken.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $updateData['user'] = $request->new_user;
        }

        // === Password Update ===
        if (in_array($request->update_option, ['password', 'both'])) {
            $validator = Validator::make($request->all(), [
                'new_password' => 'required|confirmed|min:4',
            ], [
                'new_password.required' => 'New password is required.',
                'new_password.confirmed' => 'New password confirmation does not match.',
                'new_password.min' => 'New password must be at least 4 characters.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $updateData['password'] = Hash::make($request->new_password);
        }

        // === Role Update (KMU only) ===
        if ($request->update_option === 'role') {
            if (session('admin_role') !== 'KMU') {
                return back()->with('error', 'Only KMU Super Admin can change roles.');
            }

            $validator = Validator::make($request->all(), [
                'new_role' => 'required|in:KMU,IPTBM,TBI,TBI_AGRIBUS,TBI_TLU,RESEARCH,EXTENSION',
            ], [
                'new_role.required' => 'Please select a role.',
                'new_role.in' => 'Invalid role selected.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $updateData['role'] = $request->new_role;
        }

        if (empty($updateData)) {
            return back()->with('error', 'No changes were made.');
        }

        $admin->update($updateData);

        // Update session if the logged-in user changed their own username or role
        if ($admin->id == session('admin_id')) {
            if (isset($updateData['user'])) {
                session()->put('admin_user', $updateData['user']);
            }
            if (isset($updateData['role'])) {
                session()->put('admin_role', $updateData['role']);
                // If role changed, log out to refresh permissions
                return redirect()->route('admin.login')->with('success', 'Role updated successfully. Please login again.');
            }
        }

        return back()->with('success', 'Account updated successfully.');

    } catch (\Exception $e) {
        return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}


    // === Delete Account ===
    public function destroy($id)
    {
        // Prevent deleting the logged-in KMU Super Admin
        if ((int) $id === (int) session('admin_id')) {
            return redirect()->back()->with('error', 'You cannot delete your own account.');
        }

        try {
            $admin = Admin::findOrFail($id);
            $admin->delete();

            return redirect()->back()->with('success', 'Account deleted successfully.');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the account: '.$e->getMessage());
        }
    }
}
