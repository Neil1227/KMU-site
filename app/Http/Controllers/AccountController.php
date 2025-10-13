<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    public function index()
    {
        return view('admin.account-settings');
    }

    // === Store New Account ===
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user' => 'required|string|unique:admins,user',
            'password' => 'required|confirmed|min:4',
            'role' => 'required|in:KMU,IPTBM,TBI',
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
            return back()->with('error', 'An error occurred while creating the account: ' . $e->getMessage());
        }
    }

    // === Update Existing Account ===
    public function update(Request $request)
    {
        try {
            $adminId = Session::get('admin_id');
            $admin = Admin::findOrFail($adminId);

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
            if (!Hash::check($request->current_password, $admin->password)) {
                return back()->with('error', 'Current password is incorrect.');
            }

            $updateData = [];

            // === Update Username ===
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
                Session::put('admin_user', $request->new_user);
            }

            // === Update Password ===
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

            // === Update Role ===
            if ($request->update_option === 'role') {
                if ($admin->role !== 'KMU') {
                    return back()->with('error', 'Only KMU Super Admin can change roles.');
                }

                $validator = Validator::make($request->all(), [
                    'new_role' => 'required|in:KMU,IPTBM,TBI',
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

            return back()->with('success', 'Account updated successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }
}
