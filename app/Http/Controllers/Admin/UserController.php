<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user's role.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'nullable|exists:roles,id',
        ]);

        $user->update(['role_id' => $request->role_id]);

        return redirect()->route('admin.users.index')
            ->with('success', 'User role updated successfully.');
    }
}
