<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function members()
    {
        $members = User::with('role')->get();
        return view('admin.members', compact('members'));
    }

    public function roles()
    {
        $roles = Role::with('permissions')->get();
        return view('admin.roles', compact('roles'));
    }

    public function createLibrarian()
    {
        return view('admin.create_librarian');
    }

    public function storeLibrarian(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $librarianRole = Role::where('name', 'Librarian')->first();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $librarianRole ? $librarianRole->id : null,
        ]);

        return redirect()->route('members.index')->with('success', 'Librarian created successfully.');
    }
}
